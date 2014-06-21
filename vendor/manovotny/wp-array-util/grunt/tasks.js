module.exports = function (grunt) {

    'use strict';

    grunt.registerTask('default', [
        'build',
        'watch'
    ]);

    grunt.registerTask('build', [
        'clean',
        'js',
        'php'
    ]);

    grunt.registerTask('bump', [
        'replace'
    ]);

    grunt.registerTask('js', [
        'jslint'
    ]);

    grunt.registerTask('php', [
        'phpunit',
        'phplint'
    ]);

};
