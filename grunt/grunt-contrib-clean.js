module.exports = function (grunt) {

    'use strict';

    grunt.config('clean', {
        css: [
            'admin/css'
        ],
        js: [
            'admin/js/*.js'
        ],
        lib: [
            'composer.lock',
            'lib'
        ]
    });

};