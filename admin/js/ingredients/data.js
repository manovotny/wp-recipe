(function ($, wp) {

    'use strict';

    var group = {
            add: '.' + wprecipe.ingredient.group.classes.add,
            item: wprecipe.ingredient.group.classes.item,
            keys: wprecipe.ingredient.group.keys,
            list: '.' + wprecipe.ingredient.group.classes.list,
            markup: wprecipe.ingredient.group.markup,
            remove: '.' + wprecipe.ingredient.group.classes.remove
        },
        ingredient = {
            add: '.' + wprecipe.ingredient.classes.add,
            id: wprecipe.ingredient.id,
            item: '.' + wprecipe.ingredient.classes.item,
            list: '.' + wprecipe.ingredient.classes.list,
            markup: wprecipe.ingredient.markup,
            remove: '.' + wprecipe.ingredient.classes.remove
        };

    wp.namespace('wprecipe.admin.ingredients.data', {
        group: group,
        ingredient: ingredient
    });

}(jQuery, wp));