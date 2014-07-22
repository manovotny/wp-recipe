(function ($, wp) {

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

    wp.namespace('wprecipe.admin.ingredients.data', {
        group: group,
        ingredient: ingredient
    });

}(jQuery, wp));