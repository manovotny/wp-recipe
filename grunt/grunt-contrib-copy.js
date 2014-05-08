module.exports = function (grunt) {

    'use strict';

    grunt.config('copy', {
        composer: {
            files: [
                {
                    expand: true,
                    cwd: 'vendor/manovotny',
                    src: [
                        '**/*'
                    ],
                    dest: 'lib'
                }
            ]
        }
    });

};