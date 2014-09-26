module.exports = function (grunt) {

    'use strict';

    var config = require('config');

    grunt.config('clean', {
        generated: [
            config.paths.source + '/admin/css',
            config.paths.source + '/site/css',

            config.paths.source + '/**/' + config.files.browserify + '.*.js',

            'composer.lock'
        ]
    });

};