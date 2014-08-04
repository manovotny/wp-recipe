(function (global) {
    'use strict';

    function namespace(ns, api) {
        var object = this,
            levels = ns.split('.'),
            levelCount = levels.length,
            i;

        for (i = 0; i < levelCount; i += 1) {
            if (object[levels[i]] === undefined) {
                if (i === levelCount - 1) {
                    object[levels[i]] = api || {};
                } else {
                    object[levels[i]] = {};
                }
            }

            object = object[levels[i]];
        }

        if (api.init) {
            api.init();
        }
    }

    if (undefined === global.wp) {
        global.wp = {
            namespace: namespace
        };
    } else if (undefined === global.wp['namespace']) {
        global.wp['namespace'] = namespace;
    }

}(this));;(function ($, wp) {

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

}(jQuery, wp));;(function ($, wp) {

    'use strict';

    var data = wp.wprecipe.admin.ingredients.data;

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

    wp.namespace('wprecipe.admin.ingredients.common', {
        generateForm: generateForm,
        generateInputName: generateInputName,
        generateUniqueId: generateUniqueId,
        init: init
    });

}(jQuery, wp));;(function ($, wp) {

    'use strict';

    var common = wp.wprecipe.admin.ingredients.common,
        data = wp.wprecipe.admin.ingredients.data;

    function remove(event) {
        event.preventDefault();

        var $ingredient = $(event.currentTarget).parents(data.ingredient.item).remove();

        $ingredient.find(data.ingredient.remove).off('click', remove);

        common.generateForm();
    }

    function add(event) {
        event.preventDefault();

        var $ingredient = $(data.ingredient.markup),
            $ingredientInput = $ingredient.find('input'),
            $parentListItem = $(event.currentTarget).parents('li'),
            $list;

        common.generateUniqueId($ingredientInput);

        if ($parentListItem.hasClass(data.group.item)) {
            $list = $parentListItem.find(data.group.list);
        } else {
            $list = $(data.ingredient.list);
        }

        $list.append($ingredient);

        $ingredientInput.focus();

        $ingredient.find(data.ingredient.remove).on('click', remove);

        common.generateForm();
    }

    function init() {
        $(data.ingredient.add).on('click', add);
        $(data.ingredient.remove).on('click', remove);
    }

    wp.namespace('wprecipe.admin.ingredients.ingredient', {
        add: add,
        init: init,
        remove: remove
    });

}(jQuery, wp));;(function ($, wp) {

    'use strict';

    var common = wp.wprecipe.admin.ingredients.common,
        data = wp.wprecipe.admin.ingredients.data,
        ingredient = wp.wprecipe.admin.ingredients.ingredient;

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

    wp.namespace('wprecipe.admin.ingredients.group', {
        init: init
    });

}(jQuery, wp));