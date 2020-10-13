'use strict';

const { src, dest, series,  watch} = require('gulp');
const sass = require('gulp-sass');

sass.compiler = require('node-sass');

const sourceDir = './assets/scss/';
const destDir = './assets/base_css/';

function sassCompile() {
    return src(sourceDir + 'layout.scss')
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(dest(destDir));
}

function sassWatch(){
    watch('./assets/scss/*.scss', series(sassCompile));
}

exports.default = sassWatch