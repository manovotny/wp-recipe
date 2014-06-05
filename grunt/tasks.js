module.exports = function (grunt) {

    'use strict';

    grunt.registerTask('default', [
        'build',
        'watch'
    ]);

    grunt.registerTask('build', [
        'lib',
        'css',
        'js',
        'bump'
    ]);

    grunt.registerTask('bump', [
        'replace'
    ]);

    grunt.registerTask('css', [
        'clean:css',
        'scsslint',
        'sass',
        'cssmin'
    ]);

    grunt.registerTask('lib', [
        'clean:lib',
        'copy'
    ]);

    grunt.registerTask('js', [
        'clean:js',
        'jslint',
        'concat',
        'uglify'
    ]);

};
