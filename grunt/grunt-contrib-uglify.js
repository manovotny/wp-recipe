module.exports = function (grunt) {

    'use strict';

    grunt.config('uglify', {
        admin: {
            files: {
                'admin/js/admin.min.js': [
                    'admin/js/**/*.concat.js'
                ]
            }
        }
    });

};