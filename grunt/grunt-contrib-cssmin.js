module.exports = function (grunt) {

    'use strict';

    grunt.config('cssmin', {
        admin: {
            options: {
                keepSpecialComments: 0
            },
            files: {
                'admin/css/recipe-editor.css': [
                    'temp/admin/css/recipe-editor.css'
                ]
            }
        }
    });

};