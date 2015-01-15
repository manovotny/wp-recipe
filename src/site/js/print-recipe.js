(function ($) {

    'use strict';

    var data = require('./recipe-data'),
        printableIframeId = 'printable-iframe';

    function iframeLoaded() {
        var iframe = document.frames ? document.frames[printableIframeId] : document.getElementById(printableIframeId),
            iframeWindow = iframe.contentWindow || iframe;

        iframeWindow.focus();
        iframeWindow.print();
    }

    function printRecipe(event) {
        var $recipe = $(event.currentTarget).closest('.recipe').clone(),
            $iframe,
            content,
            iframe,
            styles = '';

        $recipe.find('.recipe-controls').remove();

        $iframe = $('iframe#' + printableIframeId);

        if (!$iframe.length) {
            $iframe = $('<iframe id="' + printableIframeId + '"></iframe>');

            $('body').append($iframe);
        }

        iframe = $iframe.get(0);

        if (iframe.attachEvent) {
            iframe.attachEvent('onload', iframeLoaded);
        } else {
            iframe.addEventListener('load', iframeLoaded, false);
        }

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
        var $controls = $('.recipe-controls'),
            $printButton,
            $printControl;

        $controls.each(function () {
            $printButton = $('<button class="print">Print Recipe</button>');
            $printControl = $('<li></li>');

            $printControl.append($printButton);

            $(this).append($printControl);

            $printButton.click(printRecipe);
        });
    }

    init();

}(jQuery));
