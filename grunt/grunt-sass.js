module.exports = function (grunt) {

    'use strict';

    var config = require('config'),
        expand = true,
        extension = '.css',
        options = {
            outputStyle: 'nested'
        },
        source = [
            '**/*.scss'
        ];

    grunt.config('sass', {
        admin: {
            options: options,
            files: [
                {
                    expand: expand,
                    cwd: config.paths.admin + '/' + config.paths.sass,
                    src: source,
                    dest: config.paths.admin + '/' + config.paths.css,
                    ext: extension
                }
            ]
        },
        site: {
            options: options,
            files: [
                {
                    expand: expand,
                    cwd: config.paths.sass,
                    src: source,
                    dest: config.paths.css,
                    ext: extension
                }
            ]
        }
    });

};