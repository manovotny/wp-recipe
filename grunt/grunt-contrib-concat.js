module.exports = function (grunt) {

    'use strict';

    grunt.config('concat', {
        options: {
            separator: ';'
        },
        admin: {
            src: [
                '!admin/js/**/*.concat.js',
                '!admin/js/**/*.min.js',
                'admin/js/**/*.js'
            ],
            dest: 'admin/js/admin.concat.js'
        }
    });

};