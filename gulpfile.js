var gulp = require('gulp');
var uglify = require('gulp-uglify');
var minifyCss = require('gulp-minify-css');
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var apidoc = require('gulp-apidoc');
var watch = require('gulp-watch');

var bases = {
	bootstrap: 'bower_components/bootstrap/dist',
	dist: 'public', 
	stylesheets: 'public/stylesheets',
	javascripts: 'public/javascripts',
	src: 'src',
	endpoints: 'src/Common/Endpoints',
	apidocuments: 'public/apidocs'
};

var paths = {
    scripts: ['Javascript/*.js'],
    bootstrap: ['css/bootstrap.min.css'],
    styles: ['public/stylesheets/*.css']
};

gulp.task('copy', function() {

	gulp.src(paths.bootstrap, {cwd: bases.bootstrap})
	.pipe(gulp.dest(bases.stylesheets));

    //gulp.src(paths.styles)

	gulp.src(paths.scripts, {cwd: bases.src})
	.pipe(uglify())
	.pipe(gulp.dest(bases.javascripts));

});

gulp.task('apidocs', function() {

	apidoc.exec({
		src: bases.endpoints,
		dest: bases.apidocuments
	});

});

gulp.task('watch', function() {

    gulp.watch(paths.scripts, ['copy']);
    gulp.watch(paths.styles, ['copy'])

});

// Define the default task as a sequence of the above tasks
gulp.task('default', ['copy']);