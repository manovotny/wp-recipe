(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
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
},{"./recipe-data":2}],2:[function(require,module,exports){
(function (global){
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
}).call(this,typeof global !== "undefined" ? global : typeof self !== "undefined" ? self : typeof window !== "undefined" ? window : {})
},{}],3:[function(require,module,exports){
(function ($) {

    'use strict';

    var common = require('./recipe-common'),
        data = require('./recipe-data'),
        ingredient = require('./recipe-ingredient');

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

    init();

}(jQuery));
},{"./recipe-common":1,"./recipe-data":2,"./recipe-ingredient":4}],4:[function(require,module,exports){
(function ($) {

    'use strict';

    var common = require('./recipe-common'),
        data = require('./recipe-data');

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

    module.exports = {
        add: add,
        remove: remove
    };

    init();

}(jQuery));
},{"./recipe-common":1,"./recipe-data":2}]},{},[1,2,3,4]);
