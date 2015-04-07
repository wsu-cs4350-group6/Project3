var gulp = require('gulp');
var uglify = require('gulp-uglify');
var apidoc = require('gulp-apidoc')

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
 styles: ['css/bootstrap.min.css']
};

gulp.task('copy', function() {

	gulp.src(paths.styles, {cwd: bases.bootstrap})
	.pipe(gulp.dest(bases.stylesheets));

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

// Define the default task as a sequence of the above tasks
gulp.task('default', ['copy']);