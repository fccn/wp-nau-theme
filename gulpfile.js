// gulp file configuration used to compile sass files to css.
'use strict';

const { src, dest, series,  watch} = require('gulp');
const sass = require('gulp-sass');
const sourcemaps = require('gulp-sourcemaps');

sass.compiler = require('node-sass');

const sourceDir = './scss/';
const destDir = './assets/css/';

function sassCompile() {
    return src(sourceDir + 'layout.scss')
        .pipe(sourcemaps.init())
        .pipe(sass({outputStyle: 'compressed'})
        	.on('error', sass.logError))
        .pipe(sourcemaps.write({includeContent: false}))
        .pipe(dest(destDir));
}

function sassWatch(){
    watch(sourceDir + '*.scss', series(sassCompile));
}

// Exports 2 tasks.
// a single compilation for deploy with ansible.
exports.build = series(sassCompile);

// a compilation with a watcher so every time a change is performanced on a file it's performed a compilation.
exports.default = sassWatch; 
