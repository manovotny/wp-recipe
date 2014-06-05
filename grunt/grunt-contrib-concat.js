module.exports = function (grunt) {

    'use strict';

    grunt.config('concat', {
        options: {
            separator: ';'
        },
        admin: {
            src: [
                'admin/js/recipe-editor/ingredients.js'
            ],
            dest: 'admin/js/recipe-editor.js'
        }
    });

};