module.exports = function (grunt) {

    'use strict';

    var config = require('config');

    grunt.config('curl', {
        jshintrc: {
            src: 'http://develop.svn.wordpress.org/trunk/' + config.files.jshint,
            dest: config.paths.config + '/' + config.files.jshint
        }
    });

};