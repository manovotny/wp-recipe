(function ($) {

    'use strict';

    var data = require('./recipe-data'),
        iframePrint = require('./iframe-print'),
        queryString = require('query-string'),

        recipeSelector = '.recipe',
        recipeControlsSelector = '.recipe-controls';

    function printRecipe(event) {
        var $recipe = $(event.currentTarget).closest(recipeSelector).clone(),
            options;

        event.preventDefault();

        $recipe.find(recipeControlsSelector).remove();

        options = {
            content: $recipe.get(0).outerHTML,
            styles: data.print.styles,
            title: $recipe.find('.recipe-title').text()
        };

        iframePrint.print(options);
    }

    function init() {
        var $printRecipe = $('.recipe-print'),
            qs = queryString.parse(window.location.search.substring(1));

        $printRecipe.click(printRecipe);

        if (qs.hasOwnProperty('print-recipe')) {
            $printRecipe.click();
        }
    }

    init();

}(jQuery));
