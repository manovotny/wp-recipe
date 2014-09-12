module.exports = function (grunt) {

    'use strict';

    var config = require('config'),
        expand = true,
        extension = '.min.css',
        options = {
            keepSpecialComments: 0
        },
        source = [
            '*.css',

            '!*.min.css'
        ];

    grunt.config('cssmin', {
        admin: {
            options: options,
            expand: expand,
            cwd: config.paths.admin + '/' + config.paths.css,
            src: source,
            dest: config.paths.admin + '/' + config.paths.css,
            ext: extension
        },
        css: {
            options: options,
            expand: expand,
            cwd: config.paths.css,
            src: source,
            dest: config.paths.css,
            ext: extension
        }
    });

};