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
        'node_modules/jquery-ui-dist/jquery-ui.min.js',
        `${basePath}particles.js`,
        `${basePath}main.js`
    ];

function css () {
   return gulp.src('resources/css/style.css')
            .pipe(sass())
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

function js () {
   return gulp.src(jsPaths)
       .pipe(concat('all.js'))
       .pipe(uglify())
       .pipe(gulp.dest('public/js'));
}

gulp.task('imgCompress', function (){
   return gulp.src('resources/img/*')
       .pipe(imagemin())
       .pipe(gulp.dest('public/img'));
});

function watch () {
    gulp.watch('resources/sass/**/*.*', gulp.series(css));
    gulp.watch([
        'public/js/**/*.*',
        'public/css/**/*.*',
        'public/img/**/*.*',
        'resources/views/**/*.*'
    ], gulp.series(syncReload));
    gulp.watch(basePath+'*', gulp.series(js))
}

gulp.task('default', gulp.series(gulp.parallel(css, js, syncStart), watch));