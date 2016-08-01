var gulp = require('gulp');

var config = require('../../../gulp-config.json');

// Dependencies
var browserSync = require('browser-sync');
var rm          = require('gulp-rimraf');
var gutil 			= require('gulp-util');

var baseTask  = 'modules.frontend.map';
var extPath   = './src';

// Clean
gulp.task('clean:' + baseTask, function() {
	gulp.src([
			config.wwwDir + '/language/en-GB/en-GB.mod_tx_google_map.ini',
			config.wwwDir + '/language/en-GB/en-GB.mod_tx_google_map.sys.ini'
    	], { read: false }
  	).pipe(rm({ force: true }));

	return gulp.src(config.wwwDir + '/modules/mod_tx_google_map', { read: false })
		.pipe(rm({ force: true }));
});

// Copy module
gulp.task('copy:' + baseTask, ['clean:' + baseTask], function() {
	gulp.src([
	    extPath + '/language/en-GB/**'
	  ]).pipe(gulp.dest(config.wwwDir + '/language/en-GB'));
	return gulp.src(extPath + '/**')
	.pipe(gulp.dest(config.wwwDir + '/modules/mod_tx_google_map'));
});


// Watch: Module
gulp.task('watch:' + baseTask, function() {
	gulp.watch(extPath + '/**', ['copy:' + baseTask, browserSync.reload]);
});