module.exports = function (grunt) {

    'use strict';

    grunt.config('jslint', {
        admin: {
            directives: {
                browser: true,
                predef: [
                    'jQuery'
                ]
            },
            src: [
                'admin/js/**/*.js'
            ]
        },
        automation: {
            directives: {
                browser: true,
                predef: [
                    'module',
                    'require'
                ]
            },
            src: [
                'bower.json',
                'composer.json',
                'Gruntfile.js',
                'package.json',
                'grunt/*.js'
            ]
        }
    });

};