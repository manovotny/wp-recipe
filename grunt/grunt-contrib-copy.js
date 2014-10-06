module.exports = function (grunt) {

    'use strict';

    var config = require('config');

    grunt.config('copy', {
        dist: {
            expand: true,
            cwd: '.',
            src: [
                '**/*',

                '!**/.git*',
                '!**/.DS_Store',
                '!**/bower.json',
                '!**/composer.json',
                '!**/composer.lock',
                '!**/Gruntfile.js',
                '!**/package.json',

                '!**/' + config.paths.curl + '/**',
                '!**/' + config.paths.translations + '/**',

                '!**/bower_components/**',
                '!**/config/**',
                '!**/grunt/**',
                '!**/node_modules/**',
                '!**/sass/**',
                '!**/tests/**'
            ],
            dest: 'dist'
        }
    });

};