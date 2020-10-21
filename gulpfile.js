// gulp file configuration used to compile sass files to css.
'use strict';

const { src, dest, series,  watch} = require('gulp');
const sass = require('gulp-sass');

sass.compiler = require('node-sass');

const sourceDir = './src/scss/';
const destDir = './src/base_css/';

function sassCompile() {
    return src(sourceDir + 'layout.scss')
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
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
