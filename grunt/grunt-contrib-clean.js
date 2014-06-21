module.exports = function (grunt) {

    'use strict';

    grunt.config('clean', {
        css: [
            'admin/css'
        ],
        packages: [
            'composer.lock',
            'lib'
        ],
        js: [
            'admin/js/*.js'
        ]
    });

};