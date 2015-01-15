(function ($) {

    'use strict';

    var data = require('./recipe-data'),
        printableIframeId = 'printable-iframe',
        recipeSelector = '.recipe',
        recipeControlsSelector = '.recipe-controls',
        recipePrintClass = 'recipe-print';

    function printIframe() {
        var iframe = document.frames ? document.frames[printableIframeId] : document.getElementById(printableIframeId),
            iframeWindow = iframe.contentWindow || iframe;

        iframeWindow.focus();
        iframeWindow.print();
    }

    function getIframe() {
        var $iframe = $('iframe#' + printableIframeId),
            iframe;

        if (!$iframe.length) {
            $iframe = $('<iframe id="' + printableIframeId + '"></iframe>');

            $('body').append($iframe);
        }

        iframe = $iframe.get(0);

        if (iframe.attachEvent) {
            iframe.attachEvent('onload', printIframe);
        } else {
            iframe.addEventListener('load', printIframe, false);
        }

        return iframe;
    }

    function getIframeStyles() {
        var styles;

        _.each(data.print.styles, function (style) {
            styles += '<link type="text/css" rel="stylesheet" href="' + style + '" />';
        });

        return styles;
    }

    function getIframeContent($recipe, styles) {
        var content;

        $recipe.find(recipeControlsSelector).remove();

        content =
            '<html>' +
                '<head>' +
                    '<title>' + $recipe.find('.recipe-title').text() + '</title>' +
                    styles +
                '</head>' +
                '<body>' +
                    $recipe.get(0).outerHTML +
                '</body>' +
            '</html>';

        return content;
    }

    function printRecipe(event) {
        var $recipe = $(event.currentTarget).closest(recipeSelector).clone(),
            content,
            iframe,
            styles;

        iframe = getIframe();
        styles = getIframeStyles();
        content = getIframeContent($recipe, styles);

        iframe.contentWindow.document.open();
        iframe.contentWindow.document.write(content);
        iframe.contentWindow.document.close();
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
