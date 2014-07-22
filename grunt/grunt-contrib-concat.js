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

                'admin/js/namespace.js',
                'admin/js/ingredients/data.js',
                'admin/js/ingredients/common.js',
                'admin/js/ingredients/ingredient.js',
                'admin/js/ingredients/group.js',
                'admin/js/**/*.js'
            ],
            dest: 'admin/js/admin.concat.js'
        }
    });

};