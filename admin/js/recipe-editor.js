(function ($) {

    'use strict';

    var ingredient =
        '<li class="ingredient">' +
        '<label class="item-label">Ingredient</label>' +
        '<input class="item-control" name="' + phpData.ingredientsId + '[]" type="text" value="" />' +
        '<span class="item-action">' +
        '<button class="remove-ingredient button">Remove</button>' +
        '</span>' +
        '</li>';

    function generateUniqueId($ingredient) {
        var id = _.uniqueId('wp-recipe-ingredient-');

        $ingredient.find('label').attr('for', id);
        $ingredient.find('input').attr('id', id);
    }

    function removeIngredient(event) {
        event.preventDefault();

        var $ingredient = $(event.currentTarget).parents('.ingredient').remove();

        $ingredient.find('.remove-ingredient').off('click', removeIngredient);
    }

    function addIngredient(event) {
        event.preventDefault();

        var $ingredient = $(ingredient);

        generateUniqueId($ingredient);

        $('.ingredients').append($ingredient);

        $ingredient.find('.remove-ingredient').on('click', removeIngredient);
    }

    function init() {
        var $ingredients = $('.ingredients');

        _.each($ingredients, function (ingredient) {

            generateUniqueId($(ingredient));

        });

        $('.add-ingredient').on('click', addIngredient);
        $('.remove-ingredient').on('click', removeIngredient);
    }

    init();

}(jQuery));