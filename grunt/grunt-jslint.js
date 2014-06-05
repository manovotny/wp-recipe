module.exports = function (grunt) {

    'use strict';

    grunt.config('jslint', {
        js: {
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