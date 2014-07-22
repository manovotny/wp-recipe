(function ($, wp) {

    'use strict';

    var common = wp.wprecipe.admin.ingredients.common,
        data = wp.wprecipe.admin.ingredients.data;

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
            $list = $parentListItem.find('ul');
        } else {
            $list = $(data.ingredient.list);
        }

        $list.append($ingredient);

        $ingredient.find(data.ingredient.remove).on('click', remove);

        common.generateForm();
    }

    function init() {
        $(data.ingredient.add).on('click', add);
        $(data.ingredient.remove).on('click', remove);
    }

    wp.namespace('wprecipe.admin.ingredients.ingredient', {
        add: add,
        init: init,
        remove: remove
    });

}(jQuery, wp));