module.exports = function (grunt) {

    'use strict';

    grunt.config('clean', {
        inc: [
            'composer.lock',
            'lib'
        ]
    });

};