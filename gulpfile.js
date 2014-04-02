var gulp = require('gulp'),
    sass = require('gulp-ruby-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    minifycss = require('gulp-minify-css'),
    rename = require('gulp-rename'),
    changed = require('gulp-changed'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify');

gulp.task('styles', function() {
    gulp.src('./scss/app.scss')
        .pipe(sass({loadPath: ['bower_components/foundation/scss'], quiet: true, trace: true, style: 'nested'}))
        .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1'))
        .pipe(gulp.dest('stylesheets'))
        .pipe(rename({suffix: '.min'}))
        .pipe(minifycss())
        .pipe(gulp.dest('stylesheets'))
});

gulp.task('foundation', function() {
    gulp.src(['./bower_components/foundation/js/vendor/modernizr.js', './bower_components/foundation/js/vendor/fastclick.js', './bower_components/foundation/js/vendor/placeholder.js', './bower_components/foundation/js/vendor/jquery.cookie.js', './bower_components/foundation/js/foundation/foundation.js', './bower_components/foundation/js/foundation/foundation.*.js'])
        .pipe(changed('./js/'))
        .pipe(concat('foundation.all.js'))
        .pipe(gulp.dest('./js/'))
        .pipe(rename({suffix: '.min'}))
        .pipe(uglify())
        .pipe(gulp.dest('./js/'))
});

gulp.task('default', ['styles', 'foundation'], function() {
    gulp.watch(['./scss/*.scss', './gulpfile.js'], ['styles']);
});
