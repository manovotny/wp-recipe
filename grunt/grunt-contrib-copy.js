module.exports = function (grunt) {

    'use strict';

    grunt.config('copy', {
        composer: {
            files: [
                {
                    expand: true,
                    cwd: 'vendor/manovotny/wp-taxonomy-util',
                    src: [
                        '**/*'
                    ],
                    dest: 'inc/wp-taxonomy-util'
                }
            ]
        }
    });

};