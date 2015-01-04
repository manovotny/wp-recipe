module.exports = (function () {

    'use strict';

    return {
        author: {
            email: 'manovotny@gmail.com',
            name: 'Michael Novotny',
            url: 'http://manovotny.com',
            username: 'manovotny'
        },
        files: {
            browserify: 'bundle'
        },
        paths: {
            curl: 'curl_downloads',
            source: 'src',
            translations: 'lang'
        },
        project: {
            composer: {
                name: 'manovotny/wp-recipe',
                type: 'library' // Should be `library` or `project`.
            },
            description: 'Add recipes to WordPress.',
            git: 'git://github.com/manovotny/wp-recipe.git',
            name: 'WP Recipe',
            slug: 'wp-recipe',
            type: 'plugin', // Should be `plugin` or `theme`.
            url: 'https://github.com/manovotny/wp-recipe',
            version: '1.6.1'
        }
    };

}());
