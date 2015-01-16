(function ($) {

    'use strict';

    var data = require('./recipe-data'),
        iframePrint = require('./iframe-print'),

        recipeSelector = '.recipe',
        recipeControlsSelector = '.recipe-controls',
        recipePrintClass = 'recipe-print';

    function printRecipe(event) {
        var $recipe = $(event.currentTarget).closest(recipeSelector).clone(),
            options;

        $recipe.find(recipeControlsSelector).remove();

        options = {
            content: $recipe.get(0).outerHTML,
            styles: data.print.styles,
            title: $recipe.find('.recipe-title').text()
        };

        iframePrint.print(options);
    }

    function addPrintButtons() {
        var $controls = $(recipeControlsSelector),
            $printButton,
            $printControl;

        $controls.each(function () {
            $printButton = $('<button class="' + recipePrintClass + '">Print Recipe</button>');
            $printControl = $('<li></li>');

            $printControl.append($printButton);

            $(this).append($printControl);

            $printButton.click(printRecipe);
        });
    }

    function init() {
        addPrintButtons();
    }

    init();

}(jQuery));
