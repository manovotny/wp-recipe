module.exports = function (grunt) {

    'use strict';

    grunt.config('copy', {
        bower: {
            files: [
                {
                    expand: true,
                    cwd: 'bower_components/sass-lint-config',
                    src: [
                        '.scss-lint.yml'
                    ],
                    dest: '.'
                }
            ]
        },
        composer: {
            files: [
                {
                    expand: true,
                    cwd: 'vendor/manovotny',
                    src: [
                        '**/*',

                        '!**/grunt/**',
                        '!**/tests/**',
                        '!**/vendor/**',

                        '!**/.git*',
                        '!**/bower.json',
                        '!**/composer.json',
                        '!**/Gruntfile.js',
                        '!**/package.json'
                    ],
                    dest: 'lib'
                }
            ]
        }
    });

};