'use strict';

var gulp = require('gulp');
const { series } = require('gulp');
var sass = require('gulp-sass')(require('sass'));
var gulpIf = require('gulp-if');
var cssnano = require('gulp-cssnano');
var uglify = require('gulp-uglify');
var babel = require('gulp-babel');
var useref = require('gulp-useref');

function buildStyles() {
  return gulp.src('./src/App/templates/sass/**/*.scss')
    .pipe(sass({
      includePaths: ['node_modules']
    }))
    .pipe(sass().on('error', sass.logError))
    .pipe(gulpIf('*.css', cssnano()))
    .pipe(gulp.dest('./public/css'));
};
function buildScript() {
  return gulp.src('./src/App/templates/js/technobureau.js')
    .pipe(useref())
    .pipe(babel())
    .pipe(gulpIf('*.js', uglify()))
    .pipe(gulp.dest('./public/js'));
};
exports.buildStyles = buildStyles;
exports.buildScript = buildScript;
exports.default = series(buildStyles, buildScript);