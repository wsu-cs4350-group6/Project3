var gulp = require('gulp');
var clean = require('gulp-clean');
var uglify = require('gulp-uglify');

var bases = {
	bootstrap: 'bower_components/bootstrap/dist',
	dist: 'public', 
	stylesheets: 'public/stylesheets',
	javascripts: 'public/javascripts',
	src: 'src'
};

var paths = {
 scripts: ['Javascript/*.js'],
 styles: ['css/bootstrap.min.css']
};

gulp.task('copy', function() {

	gulp.src(paths.styles, {cwd: bases.bootstrap})
	.pipe(gulp.dest(bases.stylesheets));

	gulp.src(paths.scripts, {cwd: bases.src})
	.pipe(uglify())
	.pipe(gulp.dest(bases.javascripts));

});

// Define the default task as a sequence of the above tasks
gulp.task('default', ['copy']);