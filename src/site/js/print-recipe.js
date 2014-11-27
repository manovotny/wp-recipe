(function ($) {

    'use strict';

    function printRecipe(event) {
        var $body = $('body'),
            $recipe = $(event.currentTarget).parents('.recipe').clone(),
            printableClass = 'printable-recipe',
            printableSelector = '.' + printableClass,
            printButtonSelector = '.print';

        $recipe.addClass(printableClass);

        $recipe.find(printButtonSelector).remove();

        $body.append($recipe);

        window.print();

        $body.find(printableSelector).remove();
    }

    function init() {
        $('.recipe .print').on('click', printRecipe);
    }

    init();

}(jQuery));
