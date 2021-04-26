// Required
const gulp = require('gulp');
const sourcemaps = require('gulp-sourcemaps');
const sass = require("gulp-sass");
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cssmin = require('gulp-cssmin');
const rename = require('gulp-rename');
const { series } = require('gulp');
const imagemin = require('gulp-imagemin');
const concat = require('gulp-concat');
const terser = require('gulp-terser');

// Files path
const source = './assets';
const destination = './dist';

/*
SASS
 */

//Compile sass + autoprefixer + soucemaps
gulp.task('sass', function () {
    return gulp.src(source + '/css/**/*.scss')
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(postcss([autoprefixer()]))
        .pipe(sourcemaps.write('./maps'))
        .pipe(gulp.dest(destination));
});

//Create a css.min for production environment

gulp.task('minify-css', async function () {
    gulp.src('dist/style.css')
        .pipe(cssmin())
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest(destination));
});

/*
IMAGES
 */

//Compress images

gulp.task('compress-images', async function () {
    return gulp.src('assets/img/**/*')
        .pipe(imagemin([
            imagemin.gifsicle({ interlaced: true }),
            imagemin.mozjpeg({ quality: 75, progressive: true }),
            imagemin.optipng({ optimizationLevel: 5 }),
            imagemin.svgo({
                plugins: [
                    { sortAttrs: true },
                ]
            })
        ], {
            verbose: true
        }))
        .pipe(gulp.dest('dist/img'))
});

/*
JAVASCRIPT
 */

gulp.task('js-front', function () {
    return gulp.src('assets/js/front/**/*.js')
        .pipe(concat('scripts.js'))
        .pipe(gulp.dest('dist/js'))
        .pipe(rename('scripts.min.js'))
        .pipe(terser())
        .pipe(gulp.dest('dist/js'));
});

gulp.task('js-admin', function () {
    return gulp.src('assets/js/admin/**/*.js')
        .pipe(gulp.dest('dist/js/admin'))
        .pipe(terser())
        .pipe(gulp.dest('dist/js/admin'));
});

/*
COMMON TASKS
 */

//Watch

gulp.task('watch', function () {
    //SASS
    gulp.watch([source + '/css/**/*.scss', 'gulpfile.js'], gulp.series('sass', 'minify-css'));
    //Images
    gulp.watch([source + '/img/**/*'], gulp.parallel('compress-images'));
    //Javascript
    gulp.watch([source + '/js/**/*'], gulp.parallel('js-front', 'js-admin'));
});

//Compile function
exports.compile = series('sass', 'minify-css', 'js-front', 'js-admin', 'compress-images');
