(function ($) {

    'use strict';

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

        var $ingredient = $(phpData.ingredientMarkup);

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