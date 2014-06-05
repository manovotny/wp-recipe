(function ($) {

    'use strict';

    var ingredient =
        '<li class="ingredient">' +
        '<label for="ingredient" class="item-label">Ingredient</label>' +
        '<input id="ingredient" class="item-control" name="ingredient" type="text" value="" />' +
        '<span class="item-action">' +
        '<button class="remove-ingredient button">Remove</button>' +
        '</span>' +
        '</li>';

    function removeIngredient(event) {

        event.preventDefault();

        var $ingredient = $(event.currentTarget).parents('.ingredient').remove();

        $ingredient.find('.remove-ingredient').off('click', removeIngredient);

    }

    function addIngredient(event) {

        event.preventDefault();

        var $ingredient = $(ingredient);

        $('.ingredients').append($ingredient);

        $ingredient.find('.remove-ingredient').on('click', removeIngredient);

    }

    function init() {

        $('.add-ingredient').on('click', addIngredient);
        $('.remove-ingredient').on('click', removeIngredient);

    }

    init();

}(jQuery));