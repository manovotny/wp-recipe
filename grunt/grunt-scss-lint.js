module.exports = function (grunt) {

    'use strict';

    var config = require('config');

    grunt.config('scsslint', {
        sass: {
            options: {
                config: config.paths.config + '/' + config.files.sassLint
            },
            src: [
                config.paths.admin + '/' + config.paths.sass + '/**/*.scss',
                config.paths.sass + '/**/*.scss'
            ]
        }
    });

};