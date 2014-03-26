var gulp = require('gulp'),
    sass = require('gulp-ruby-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    minifycss = require('gulp-minify-css'),
    rename = require('gulp-rename');

gulp.task('styles', function() {
    gulp.src('scss/app.scss')
        .pipe(sass({loadPath: ['bower_components/foundation/scss'], quiet: true, trace: true, style: 'nested'}))
        .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1'))
        .pipe(gulp.dest('stylesheets'))
        .pipe(rename({suffix: '.min'}))
        .pipe(minifycss())
        .pipe(gulp.dest('stylesheets'))
});

gulp.task('watch', function() {
    gulp.watch(['scss/*.scss', 'gulpfile.js'], ['styles']);
});

gulp.task('default', ['watch']);
