module.exports = function (grunt) {

    'use strict';

    grunt.config('sass', {
        admin: {
            options: {
                noCache: true
            },
            files: [
                {
                    expand: true,
                    cwd: 'admin/sass',
                    src: ['**/*.scss'],
                    dest: 'admin/css',
                    ext: '.css'
                }
            ]
        }
    });

};