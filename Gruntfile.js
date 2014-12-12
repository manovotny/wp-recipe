module.exports = function (grunt) {

    'use strict';

    require('time-grunt')(grunt);

    require('load-grunt-config')(grunt, {
        loadGruntTasks: {
            pattern: [
                'grunt-*'
            ]
        }
    });

    grunt.loadTasks('grunt');

};
