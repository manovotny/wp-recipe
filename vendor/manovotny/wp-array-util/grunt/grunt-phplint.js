module.exports = function (grunt) {

    'use strict';

    grunt.config('phplint', {
        files: [
            'classes/**/*.php',
            'tests/**/*.php'
        ]
    });

};