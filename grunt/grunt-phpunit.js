module.exports = function (grunt) {

    'use strict';

    grunt.config('phpunit', {
        options: {
            bin: 'vendor/bin/phpunit',
            colors: true,
            coverage: true
        },
        tests: {
            dir: 'tests'
        }
    });

};