var gulp = require('gulp');
var concat = require('gulp-concat');
var sourcemaps = require('gulp-sourcemaps');
var cssnano = require('gulp-cssnano');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var uglify = require('gulp-uglify');

var stylesheets = [
  'node_modules/bootstrap/dist/css/bootstrap.min.css'
];

var scripts = [
  'node_modules/angular/angular.min.js',
  'resources/assets/js/**/*.module.js',
  'resources/assets/js/**/*.js'
];

gulp.task('scss', function() {
   return gulp.src(stylesheets)
     .pipe(sourcemaps.init())
     .pipe(sass())
     .pipe(autoprefixer({
          browsers: ['last 2 versions'],
          cascade: false
      }))
     .pipe(concat("bundle.min.css"))
     .pipe(cssnano())
     .pipe(sourcemaps.write('.'))
     .pipe(gulp.dest('public/dist/'));
});

gulp.task('js', function() {
  return gulp.src(scripts)
    .pipe(sourcemaps.init())
    .pipe(concat('bundle.min.js'))
    .pipe(uglify())
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('public/dist/'));
});


gulp.task('watch', ['scss', 'js'], function () {
  gulp.watch('resources/assets/scss/**/*.scss', ['scss']);
  gulp.watch('resources/assets/js/**/*.js', ['js']);
});

gulp.task('default', ['watch']);
