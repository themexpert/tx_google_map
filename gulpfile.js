var requireDir = require('require-dir');

var dir = requireDir('./node_modules/joomla-gulp', {recurse: true});
var dir = requireDir('./joomla-gulp', {recurse: true});

// Load config
var extension = require('./package.json');
var gulp    = require('gulp');
var zip     = require('gulp-zip');
var rm      = require('gulp-rimraf');
var replace = require('gulp-replace');
var es      = require('event-stream');

//release
gulp.task('cleanRelease', function () {
  return gulp.src('./releases', { read: false }).pipe(rm({ force: true }));
});


// identifies a dependent task must be complete before this one begins
gulp.task('release', ['cleanRelease'], function() {
	modelZip = gulp.src('./src/**')
		.pipe(replace(/##VERSION##/g, extension.version))
		.pipe(replace(/##CREATIONDATE##/g, extension.creationDate))
		.pipe(zip(extension.name + '_' + extension.version +'.zip'))
		.pipe(gulp.dest('releases'));
});
