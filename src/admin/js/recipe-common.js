(function ($) {

    'use strict';

    var data = require('./recipe-data');

    function generateUniqueId($ingredient) {
        var id = _.uniqueId(data.ingredient.id + '-');

        $ingredient.prev().attr('for', id);
        $ingredient.attr('id', id);
    }

    function generateInputName($ingredient, index, suffix) {
        var name = data.ingredient.id + '[' + index + ']';

        if (suffix) {
            name += suffix;
        }

        $ingredient.attr('name', name);
    }

    function generateIngredientGroup($item, index, generateIds) {
        var $ingredientGroup = $item.find('> input'),
            $ingredient;

        if (generateIds) {
            generateUniqueId($ingredientGroup);
        }

        generateInputName($ingredientGroup, index, '[' + data.group.keys.group + ']');

        $item.find(data.ingredient.item).each(function () {
            $ingredient = $(this).find('> input');

            if (generateIds) {
                generateUniqueId($ingredient);
            }

            generateInputName($ingredient, index, '[]');
        });
    }

    function generateIngredient($item, index, generateIds) {
        var $ingredient = $item.find('> input');

        if (generateIds) {
            generateUniqueId($ingredient);
        }

        generateInputName($ingredient, index);
    }

    function generateForm(generateIds) {
        var $ingredientList = $(data.ingredient.list + ' > li'),
            $item;

        $ingredientList.each(function (index) {
            $item = $(this);

            if ($item.hasClass(data.group.item)) {
                generateIngredientGroup($item, index, generateIds);
            } else {
                generateIngredient($item, index, generateIds);
            }
        });
    }

    function init() {
        generateForm(true);
    }

    module.exports = {
        generateForm: generateForm,
        generateInputName: generateInputName,
        generateUniqueId: generateUniqueId
    };

    init();

}(jQuery));
