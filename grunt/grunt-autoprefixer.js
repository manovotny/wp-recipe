module.exports = function (grunt) {

    'use strict';

    var config = require('config');

    grunt.config('autoprefixer', {
        options: {
            browsers: [
                'last 2 versions',
                'ie 8',
                'ie 9'
            ]
        },
        css: {
            expand: true,
            flatten: true,
            src: config.paths.css + '/**/*.css',
            dest: config.paths.css
        }
    });

};