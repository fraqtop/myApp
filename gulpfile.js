const gulp = require('gulp');
const sass = require('gulp-sass');
const csso = require('gulp-csso');
const browserSync = require('browser-sync');
const pump = require('pump');
const uglify = require('gulp-uglify');
const concat = require ('gulp-concat');

gulp.task('scss', function () {
   return gulp.src('resources/assets/sass/style.scss')
            .pipe(sass())
            .pipe(gulp.dest('resources/assets/css'));
});

gulp.task('minify',['scss'], function () {
   return gulp.src('resources/assets/css/style.css')
            .pipe(csso())
            .pipe(gulp.dest('public/css'))
            .pipe(browserSync.reload({
                stream: true
            }));
});

gulp.task('sync', ['minify', 'convert'], function () {
   browserSync({
       proxy: '127.0.0.1:8000'
   });
});

gulp.task('convert', ['concat'], function (cb) {
    pump(
        [
            gulp.src('resources/assets/js/linked/all.js'),
            uglify(),
            gulp.dest('public/js')
        ],
        cb
    );
});

gulp.task('concat', function () {
   return gulp.src('resources/assets/js/*.js')
       .pipe(concat('all.js'))
       .pipe(gulp.dest('resources/assets/js/linked'));
});

gulp.task('watcher', function () {
    gulp.watch('resources/assets/sass/**/*.*', ['minify']);
    gulp.watch('resources/views/**/*.*', browserSync.reload);
    gulp.watch('public/**/*.*', browserSync.reload);
    gulp.watch('resources/assets/js/*.js', ['convert'])
});

gulp.task('default', ['sync', 'watcher']);