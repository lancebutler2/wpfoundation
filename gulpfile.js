var gulp = require('gulp');
var sass = require('gulp-ruby-sass');

gulp.task('styles', function() {
    gulp.src('scss/app.scss')
        .pipe(sass({loadPath: ['bower_components/foundation/scss'], quiet: true, trace: true, style: 'nested'}))
        .pipe(gulp.dest('stylesheets'));
});

gulp.task('watch', function() {
    gulp.watch(['scss/*.scss', 'gulpfile.js'], ['styles']);
});

gulp.task('default', ['watch']);
