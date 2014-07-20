(function ($) {

    'use strict';

    var group = {
            add: '.' + phpData.ingredient.group.classes.add,
            item: phpData.ingredient.group.classes.item,
            keys: phpData.ingredient.group.keys,
            markup: phpData.ingredient.group.markup,
            remove: '.' + phpData.ingredient.group.classes.remove
        },
        ingredient = {
            add: '.' + phpData.ingredient.classes.add,
            id: phpData.ingredient.id,
            item: '.' + phpData.ingredient.classes.item,
            list: '.' + phpData.ingredient.classes.list,
            markup: phpData.ingredient.markup,
            remove: '.' + phpData.ingredient.classes.remove
        };

    function generateUniqueId($ingredient) {
        var id = _.uniqueId(ingredient.id + '-');

        $ingredient.prev().attr('for', id);
        $ingredient.attr('id', id);
    }

    function generateInputName($ingredient, index, suffix) {
        var name = ingredient.id + '[' + index + ']';

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

        generateInputName($ingredientGroup, index, '[' + group.keys.group + ']');

        $item.find(ingredient.item).each(function () {
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
        var $ingredientList = $(ingredient.list + ' > li'),
            $item;

        $ingredientList.each(function (index) {
            $item = $(this);

            if ($item.hasClass(group.item)) {
                generateIngredientGroup($item, index, generateIds);
            } else {
                generateIngredient($item, index, generateIds);
            }
        });
    }

    function removeIngredient(event) {
        event.preventDefault();

        var $ingredient = $(event.currentTarget).parents(ingredient.item).remove();

        $ingredient.find(ingredient.remove).off('click', removeIngredient);

        generateForm();
    }

    function addIngredient(event) {
        event.preventDefault();

        var $ingredient = $(ingredient.markup),
            $ingredientInput = $ingredient.find('input'),
            $parentListItem = $(event.currentTarget).parents('li'),
            $list;

        generateUniqueId($ingredientInput);

        if ($parentListItem.hasClass(group.item)) {
            $list = $parentListItem.find('ul');
        } else {
            $list = $(ingredient.list);
        }

        $list.append($ingredient);

        $ingredient.find(ingredient.remove).on('click', removeIngredient);

        generateForm();
    }

    function addGroup(event) {
        event.preventDefault();

        var $ingredientGroup = $(group.markup),
            $ingredientGroupInput = $ingredientGroup.find('input');

        generateUniqueId($ingredientGroupInput);

        $(ingredient.list).append($ingredientGroup);

        $ingredientGroup.find(group.remove).on('click', removeGroup);
        $ingredientGroup.find(ingredient.add).on('click', addIngredient);

        generateForm();
    }

    function removeGroup(event) {
        event.preventDefault();

        var $group = $(event.currentTarget).parents('li');

        $group.find(ingredient.item).each(function () {
            $(this).find(ingredient.remove).off('click', removeIngredient);
        });

        $group.find(group.add).off('click', addGroup);
        $group.find(group.remove).off('click', removeGroup);

        $group.remove();

        generateForm();
    }

    function init() {
        generateForm(true);

        $(group.add).on('click', addGroup);
        $(group.remove).on('click', removeGroup);

        $(ingredient.add).on('click', addIngredient);
        $(ingredient.remove).on('click', removeIngredient);
    }

    init();

}(jQuery));