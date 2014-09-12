module.exports = function (grunt) {

    'use strict';

    var config = require('config'),
        stylish = require('jshint-stylish'),

        jshintrc = config.paths.config + '/' + config.files.jshint, // .jshintrc file from WordPress core.
        options;

    if (grunt.file.exists(jshintrc)) {
        options = grunt.file.readJSON(jshintrc);
    } else {
        options = {};
    }

    // Enable Node.
    options.node = true;

    // Add ignores.
    options.ignores = [
        config.paths.admin + '/' + config.paths.js + '/**/*.concat.js',
        config.paths.admin + '/' + config.paths.js + '/**/*.min.js',
        config.paths.js + '/**/*.concat.js',
        config.paths.js + '/**/*.min.js'
    ];

    // Add reporter.
    options.reporter = stylish;

    grunt.config('jshint', {
        options: options,
        js: {
            src: [
                config.paths.admin + '/' + config.paths.js + '/**/*.js',
                config.paths.js + '/**/*.js'
            ]
        }
    });

};