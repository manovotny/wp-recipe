(function ($) {

    'use strict';

    function printRecipe(event) {
        var recipe = $(event.currentTarget).parents('.recipe').clone().get(0),
            iframe = document.createElement('iframe'),
            recipeTitle = recipe.querySelector('.title').textContent,
            content;

        recipe.querySelector('.recipe-controls').remove();

        iframe.setAttribute('id', 'printable-recipe');
        iframe.classList.add('printable-recipe');

        content =
            '<!DOCTYPE html>' +
                '<head>' +
                    '<title>' + recipeTitle + '</title>' +
                '</head>' +
                '<body>' +
                    recipe.outerHTML +
                '</body>' +
            '</html>';

        document.body.appendChild(iframe);

        iframe.contentWindow.document.open('text/htmlreplace');
        iframe.contentWindow.document.write(content);
        iframe.contentWindow.document.close();

        iframe.focus();
        iframe.contentWindow.print();

        iframe.remove();
    }

    function init() {
        $('.recipe .print').on('click', printRecipe);
    }

    init();

}(jQuery));
