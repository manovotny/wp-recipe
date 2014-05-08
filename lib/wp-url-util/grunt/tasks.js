module.exports = function (grunt) {

    'use strict';

    grunt.registerTask('default', [
        'build',
        'watch'
    ]);

    grunt.registerTask('build', [
        'js',
        'bump'
    ]);

    grunt.registerTask('bump', [
        'replace'
    ]);

    grunt.registerTask('js', [
        'jslint'
    ]);

};
