module.exports = function (grunt) {

    'use strict';

    grunt.config('phpunit', {
        classes: {
            coverage: true,
            dir: 'tests'
        },
        options: {
            bin: 'vendor/bin/phpunit',
            colors: true
        }
    });

};