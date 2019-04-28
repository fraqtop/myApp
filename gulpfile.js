const gulp = require('gulp');
const sass = require('gulp-sass');
const csso = require('gulp-csso');
const browserSync = require('browser-sync').create();
const uglify = require('gulp-uglify-es').default;
const concat = require ('gulp-concat');
const imagemin = require('gulp-imagemin');

const basePath = 'resources/js/';
const jsPaths = [
        'node_modules/jquery/dist/jquery.js',
        'node_modules/bootstrap/dist/js/bootstrap.js',
        'node_modules/bootstrap/dist/js/bootstrap.bundle.js',
        'node_modules/chart.js/dist/Chart.js',
        `${basePath}particles.js`,
        `${basePath}main.js`
    ];

function scss () {
   return gulp.src('resources/sass/style.scss')
            .pipe(sass())
            .pipe(gulp.dest('resources/css'));
}

function cssMinify () {
   return gulp.src('resources/css/style.css')
            .pipe(csso())
            .pipe(gulp.dest('public/css'));
}

function syncStart(done) {
   browserSync.init({
       proxy: '127.0.0.1'
   });
   done();
}

function syncReload(done)
{
    browserSync.reload();
    done();
}

function jsMinify () {
   return gulp.src('resources/js/linked/all.js')
       .pipe(uglify())
       .pipe(gulp.dest('public/js'));
}

function jsLink () {
   return gulp.src(jsPaths)
       .pipe(concat('all.js'))
       .pipe(gulp.dest('resources/js/linked'));
}

gulp.task('imgCompress', function (){
   return gulp.src('resources/img/*')
       .pipe(imagemin())
       .pipe(gulp.dest('public/img'));
});

function watch () {
    gulp.watch('resources/sass/**/*.*', gulp.series(scss, cssMinify));
    gulp.watch([
        'public/js/**/*.*',
        'public/css/**/*.*',
        'public/img/**/*.*',
        'resources/views/**/*.*'
    ], gulp.series(syncReload));
    gulp.watch(jsPaths, gulp.series(jsLink, jsMinify))
}

gulp.task('default', gulp.parallel(gulp.series(scss, cssMinify), gulp.series(jsLink, jsMinify), watch, syncStart));