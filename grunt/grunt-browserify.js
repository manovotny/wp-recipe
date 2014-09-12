module.exports = function (grunt) {

    'use strict';

    var config = require('config'),

        filename = 'bundle',
        adminSource = [
            config.paths.admin + '/' + config.paths.js + '/**/*.js',
            '!' + config.paths.admin + '/' + config.paths.js + '/**/*.concat.js',
            '!' + config.paths.admin + '/' + config.paths.js + '/**/*.min.js'
        ],
        source = [
            config.paths.js + '/**/*.js',
            '!' + config.paths.js + '/**/*.concat.js',
            '!' + config.paths.js + '/**/*.min.js'
        ];

    grunt.config('browserify', {
        admin: {
            options: {
                debug: true
            },
            src: adminSource,
            dest: config.paths.admin + '/' + config.paths.js + '/' + filename + '.concat.js'
        },
        admin_dist: {
            options: {
                debug: true,
                transform: [
                    'uglifyify'
                ]
            },
            src: adminSource,
            dest: config.paths.admin + '/' + config.paths.js + '/' + filename + '.min.js'
        },
        site: {
            options: {
                debug: true
            },
            src: source,
            dest: config.paths.js + '/' + filename + '.concat.js'
        },
        site_dist: {
            options: {
                debug: true,
                transform: [
                    'uglifyify'
                ]
            },
            src: source,
            dest: config.paths.js + '/' + filename + '.min.js'
        }
    });

};