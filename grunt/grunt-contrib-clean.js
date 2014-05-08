module.exports = function (grunt) {

    'use strict';

    grunt.config('clean', {
        inc: [
            'admin/css',
            'composer.lock',
            'lib',
            'temp'
        ]
    });

};