module.exports = function (grunt) {

    'use strict';

    var config = require('config');

    grunt.config('unpathify', {
        files: [
            config.paths.source + '/**/' + config.files.browserify + '.min.js'
        ]
    });

};
