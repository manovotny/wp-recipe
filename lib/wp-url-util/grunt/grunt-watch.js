module.exports = function (grunt) {

    'use strict';

    grunt.config('watch', {
        js: {
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
        }
    });

};