var gulp = require('gulp');
var concat = require('gulp-concat');
var sourcemaps = require('gulp-sourcemaps');
var cssnano = require('gulp-cssnano');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');

var stylesheets = [
  'node_modules/bootstrap/dist/css/bootstrap.min.css'
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


gulp.task('watch', ['scss'], function () {
  gulp.watch('resources/assets/scss/**/*.scss', ['scss']);
});

gulp.task('default', ['watch']);
