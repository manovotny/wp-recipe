module.exports = function (grunt) {

    'use strict';

    var config = require('config');

    grunt.config('scsslint', {
        sass: {
            options: {
                config: 'bower_components/sass-lint-config/.scss-lint.yml'
            },
            src: [
                config.paths.source + '/**/*.scss'
            ]
        }
    });

};