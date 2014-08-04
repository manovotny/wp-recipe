module.exports = function (grunt) {

    'use strict';

    grunt.config('uglify', {
        recipePostType: {
            files: {
                'admin/js/recipe-post-type.min.js': [
                    'admin/js/**/recipe-posttype.concat.js'
                ]
            }
        }
    });

};