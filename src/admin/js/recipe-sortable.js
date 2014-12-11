(function ($) {

    'use strict';

    var data = require('./recipe-data');

    function init() {
        $(data.ingredient.list).sortable({
            axis: 'y',
            connectWith: data.ingredient.list,
            cursor: 'move',
            handle: '.drag-handle',
            scroll: true
        });

        $(data.group.list).sortable({
            connectWith: data.group.list
        });
    }

    init();

}(jQuery));
