module.exports = function (grunt) {

    'use strict';

    grunt.registerTask('default', [
        'build',
        'watch'
    ]);

    grunt.registerTask('build', [
        'packages',
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

    grunt.registerTask('js', [
        'clean:js',
//        'jslint',
        'concat',
        'uglify'
    ]);

    grunt.registerTask('packages', [
        'clean:packages',
        'copy'
    ]);


};
