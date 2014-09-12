(function (global) {

    'use strict';

    var group = {
            add: '.' + global.wp_recipe.ingredient.group.classes.add,
            item: global.wp_recipe.ingredient.group.classes.item,
            keys: global.wp_recipe.ingredient.group.keys,
            list: '.' + global.wp_recipe.ingredient.group.classes.list,
            markup: global.wp_recipe.ingredient.group.markup,
            remove: '.' + global.wp_recipe.ingredient.group.classes.remove
        },
        ingredient = {
            add: '.' + global.wp_recipe.ingredient.classes.add,
            id: global.wp_recipe.ingredient.id,
            item: '.' + global.wp_recipe.ingredient.classes.item,
            list: '.' + global.wp_recipe.ingredient.classes.list,
            markup: global.wp_recipe.ingredient.markup,
            remove: '.' + global.wp_recipe.ingredient.classes.remove
        };

    module.exports = {
        group: group,
        ingredient: ingredient
    };

}(global));