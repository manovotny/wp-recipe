module.exports = function (grunt) {

    'use strict';

    grunt.config('watch', {
        automation: {
            files: [
                'bower.json',
                'composer.json',
                'grunt/*.js',
                'Gruntfile.js',
                'package.json'
            ],
            tasks: [
                'js'
            ]
        },
        js: {
            files: [
                'admin/js/**/*.js',
                '!admin/js/**/*.min.js'
            ],
            tasks: [
                'js'
            ]
        },
        sass: {
            files: [
                'admin/**/*.scss'
            ],
            tasks: [
                'css'
            ]
        }
    });

};