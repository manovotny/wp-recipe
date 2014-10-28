module.exports = function (grunt) {

    'use strict';

    grunt.config('shell', {
        install: {
            command: [
                'bower install',
                'composer install'
            ].join('&&')
        },
        refresh: {
            command: 'composer dump-autoload'
        },
        release: {
            command: 'composer update --no-dev --optimize-autoloader'
        },
        update: {
            command: [
                'npm prune',
                'npm install',
                'npm-check-updates -u',
                'npm update',
                'npm update caniuse-db',
                'bower prune',
                'bower update',
                'composer update'
            ].join('&&')
        }
    });

};
