module.exports = function (grunt) {

    'use strict';

    var config = require('config'),

        concatFilename = config.files.browserify + '.concat.js',
        minFilename = config.files.browserify + '.min.js',

        concatOptions = {
            debug: true
        },
        minOptions = {
            debug: true,
            transform: [
                'uglifyify'
            ]
        },

        adminDistPath = config.paths.source + '/admin/js/',
        adminSource = [
            config.paths.source + '/admin/js/**/*.js',
            '!' + config.paths.source + '/admin/js/**/' + config.files.browserify + '.*.js'
        ],

        siteDistPath = config.paths.source + '/site/js/',
        siteSource = [
            config.paths.source + '/site/js/**/*.js',
            '!' + config.paths.source + '/site/js/**/' + config.files.browserify + '.*.js'
        ];

    grunt.config('browserify', {
        admin: {
            options: concatOptions,
            src: adminSource,
            dest: adminDistPath + concatFilename
        },
        admin_dist: {
            options: minOptions,
            src: adminSource,
            dest: adminDistPath + minFilename
        },
        site: {
            options: concatOptions,
            src: siteSource,
            dest: siteDistPath + concatFilename
        },
        site_dist: {
            options: minOptions,
            src: siteSource,
            dest: siteDistPath + minFilename
        }
    });

};