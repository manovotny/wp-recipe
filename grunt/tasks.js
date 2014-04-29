module.exports = function (grunt) {

    'use strict';

    grunt.registerTask('default', [
        'build',
        'watch'
    ]);

    grunt.registerTask('build', [
        'lib',
        'js',
        'bump'
    ]);

    grunt.registerTask('bump', [
        'replace'
    ]);

    grunt.registerTask('lib', [
        'clean',
        'copy'
    ]);

    grunt.registerTask('js', [
        'jslint'
    ]);

};
