import gulp from 'gulp';
import babel from 'gulp-babel';
import standard from 'gulp-standard';
import sass from 'gulp-sass';
import autoprefixer from 'gulp-autoprefixer';
import concat from 'gulp-concat';
import uglify from 'gulp-uglify';
import rename from 'gulp-rename';
import cleanCSS from 'gulp-clean-css';
import del from 'del';

const paths = {
  styles: {
    src: './styles/**/*.scss',
    dest: './css/'
  },
  scripts: {
    src: './scripts/**/*.js',
    dest: './js/'
  }
};

export const clean = (done) => del([ './css/*', './js/*' ], done);

export function styles() {
  return gulp.src(paths.styles.src)
    .pipe(sass())
    .pipe(autoprefixer())
    .pipe(cleanCSS())
    .pipe(rename({
      suffix: '.min'
    }))
    .pipe(gulp.dest(paths.styles.dest));
}

export function scripts() {
  return gulp.src(paths.scripts.src, { sourcemaps: true })
    .pipe(standard())
    .pipe(standard.reporter('default'), {
      breakOnError: true,
      quiet: true
    })
    .pipe(babel())
    .pipe(uglify())
    .pipe(concat('main.min.js'))
    .pipe(gulp.dest(paths.scripts.dest));
}

export function watch() {
  gulp.watch(paths.scripts.src, scripts);
  gulp.watch(paths.styles.src, styles);
}

const build = gulp.series(clean, gulp.parallel(styles, scripts));
gulp.task('build', build);

export default build;
