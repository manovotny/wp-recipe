(function ($) {

    'use strict';

    function printRecipe(event) {
        var recipe = $(event.currentTarget).parents('.recipe').clone().get(0),
            recipeTitle = recipe.querySelector('.title').textContent,
            content,
            iframe;

        recipe.querySelector('.recipe-controls').remove();

        iframe = document.body.querySelector('iframe#printable-iframe');

        if (!iframe) {
            iframe = document.createElement('iframe');

            iframe.setAttribute('id', 'printable-iframe');
            iframe.classList.add('printable-iframe');

            document.body.appendChild(iframe);
        }

        content =
            '<!DOCTYPE html>' +
                '<head>' +
                    '<title>' + recipeTitle + '</title>' +
                '</head>' +
                '<body>' +
                    recipe.outerHTML +
                '</body>' +
            '</html>';

        iframe.contentWindow.document.open('text/htmlreplace');
        iframe.contentWindow.document.write(content);
        iframe.contentWindow.document.close();

        iframe.focus();
        iframe.contentWindow.print();
    }

    function init() {
        $('.recipe .print').on('click', printRecipe);
    }

    init();

}(jQuery));
