(function ($) {

    'use strict';

    var common = require('./recipe-common'),
        data = require('./recipe-data');

    function remove(event) {
        event.preventDefault();

        var $ingredient = $(event.currentTarget).parents(data.ingredient.item).remove();

        $ingredient.find(data.ingredient.remove).off('click', remove);

        common.generateForm();
    }

    function add(event) {
        event.preventDefault();

        var $ingredient = $(data.ingredient.markup),
            $ingredientInput = $ingredient.find('input'),
            $parentListItem = $(event.currentTarget).parents('li'),
            $list;

        common.generateUniqueId($ingredientInput);

        if ($parentListItem.hasClass(data.group.item)) {
            $list = $parentListItem.find(data.group.list);
        } else {
            $list = $(data.ingredient.list);
        }

        $list.append($ingredient);

        $ingredientInput.focus();

        $ingredient.find(data.ingredient.remove).on('click', remove);

        common.generateForm();
    }

    function init() {
        $(data.ingredient.add).on('click', add);
        $(data.ingredient.remove).on('click', remove);
    }

    module.exports = {
        add: add,
        remove: remove
    };

    init();

}(jQuery));