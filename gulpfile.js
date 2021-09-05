const gulp = require('gulp');
const uglify = require('gulp-uglify');
const concat = require('gulp-concat');
const cleanCSS = require('gulp-clean-css');

function js() {
	return gulp
		.src('assets/js/**/*.js')
		.pipe(concat('assets.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest('build/js'));
}

function css() {
	return gulp
		.src([
			'assets/css/*.css'
		])
		.pipe(concat('assets.min.css'))
		.pipe(cleanCSS())
		.pipe(gulp.dest('build/css'));
}

gulp.task('default', gulp.parallel(js, css));