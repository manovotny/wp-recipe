(function ($) {

    'use strict';

    var data = require('./recipe-data');

    function iframeLoaded(event) {
        var iframe = event.currentTarget;

        iframe.focus();
        iframe.contentWindow.print();
    }

    function printRecipe(event) {
        var $recipe = $(event.currentTarget).parents('.recipe').clone(),
            $iframe,
            printableIframe = 'printable-iframe',
            content,
            iframe,
            styles = '';

        $recipe.find('.recipe-controls').remove();

        $iframe = $('iframe#printable-iframe');

        if (!$iframe.length) {
            $iframe = $('<iframe id="' + printableIframe + '"></iframe>');

            $('body').append($iframe);
        }

        iframe = $iframe.get(0);

        iframe.onload = iframeLoaded;

        _.each(data.print.styles, function (style) {
            styles += '<link type="text/css" rel="stylesheet" href="' + style + '" />';
        });

        content =
            '<html>' +
                '<head>' +
                    '<title>' + $recipe.find('.title').text() + '</title>' +
                    styles +
                '</head>' +
                '<body>' +
                    $recipe.get(0).outerHTML +
                '</body>' +
            '</html>';

        iframe.contentWindow.document.open();
        iframe.contentWindow.document.write(content);
        iframe.contentWindow.document.close();
    }

    function init() {
        var $controls = $('.recipe-controls');

        $controls.each(function () {
            $(this).append('<li><button class="print">Print Recipe</button></li>');
        });

        $('.recipe .print').on('click', printRecipe);
    }

    init();

}(jQuery));
