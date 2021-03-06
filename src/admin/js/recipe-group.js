(function ($) {

    'use strict';

    var common = require('./recipe-common'),
        data = require('./recipe-data'),
        ingredient = require('./recipe-ingredient');

    function add(event) {
        event.preventDefault();

        var $ingredientGroup = $(data.group.markup),
            $ingredientGroupInput = $ingredientGroup.find('input');

        common.generateUniqueId($ingredientGroupInput);

        $(data.ingredient.list).append($ingredientGroup);

        $ingredientGroupInput.focus();

        $ingredientGroup.find(data.group.remove).on('click', remove);
        $ingredientGroup.find(data.ingredient.add).on('click', ingredient.add);

        common.generateForm();
    }

    function remove(event) {
        event.preventDefault();

        var $group = $(event.currentTarget).parents('li');

        $group.find(data.ingredient.item).each(function () {
            $(this).find(data.ingredient.remove).off('click', ingredient.remove);
        });

        $group.find(data.group.add).off('click', add);
        $group.find(data.group.remove).off('click', remove);

        $group.remove();

        common.generateForm();
    }

    function init() {
        $(data.group.add).on('click', add);
        $(data.group.remove).on('click', remove);
    }

    init();

}(jQuery));
