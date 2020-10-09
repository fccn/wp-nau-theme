'use strict';

const gulp = require('gulp');
const sass = require('gulp-sass');

sass.compiler = require('node-sass');

// Test Gulp is working
gulp.task('test', () => {
    console.log("Gulp is working")
});

gulp.task('sass', () => {
    return gulp.src('./assets/scss/styles.scss')
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(gulp.dest('./assets/css/'))
});

gulp.task('sass:watch', () => {
    gulp.watch('./assets/scss/*.scss', ['sass']);
});