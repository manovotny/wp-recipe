module.exports = function (grunt) {

    'use strict';

    grunt.config('watch', {
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