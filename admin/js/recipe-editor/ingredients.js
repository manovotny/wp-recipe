(function ($) {

    'use strict';

    var ingredient = {
            add: '.' + phpData.ingredient.classes.add,
            id: phpData.ingredient.classes.id + '-',
            item: '.' + phpData.ingredient.classes.item,
            list: '.' + phpData.ingredient.classes.list,
            markup: phpData.ingredient.markup,
            remove: '.' + phpData.ingredient.classes.remove
        };

    function generateUniqueId($ingredient) {
        var id = _.uniqueId(ingredient.id);

        $ingredient.find('label').attr('for', id);
        $ingredient.find('input').attr('id', id);
    }

    function removeIngredient(event) {
        event.preventDefault();

        var $ingredient = $(event.currentTarget).parents(ingredient.item).remove();

        $ingredient.find(ingredient.remove).off('click', removeIngredient);
    }

    function addIngredient(event) {
        event.preventDefault();

        var $ingredient = $(ingredient.markup);

        generateUniqueId($ingredient);

        $(ingredient.list).append($ingredient);

        $ingredient.find(ingredient.remove).on('click', removeIngredient);
    }

    function init() {
        var $ingredients = $(ingredient.list);

        $ingredients.each(function () {

            generateUniqueId($(this));

        });

        $(ingredient.add).on('click', addIngredient);
        $(ingredient.remove).on('click', removeIngredient);
    }

    init();

}(jQuery));