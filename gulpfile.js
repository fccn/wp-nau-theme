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

exports.default = sassWatch