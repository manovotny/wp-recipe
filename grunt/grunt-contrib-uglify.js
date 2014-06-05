module.exports = function (grunt) {

    'use strict';

    grunt.config('uglify', {
        admin: {
            files: {
                'admin/js/recipe-editor.min.js': [
                    'admin/js/recipe-editor.js'
                ]
            }
        }
    });

};