module.exports = function (grunt) {

    'use strict';

    grunt.config('cssmin', {
        admin: {
            options: {
                keepSpecialComments: 0
            },
            files: {
                'admin/css/recipe-post-type.min.css': [
                    'admin/css/recipe-post-type.css'
                ]
            }
        }
    });

};