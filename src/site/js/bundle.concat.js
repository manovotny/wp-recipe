(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
(function ($) {

    'use strict';

    var printableIframeId = 'printable-iframe';

    function printIframe() {
        var iframe = document.frames ? document.frames[printableIframeId] : document.getElementById(printableIframeId),
            iframeWindow = iframe.contentWindow || iframe;

        iframeWindow.focus();
        iframeWindow.print();
    }

    function createIframe() {
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

    function createIframeStyles(styles) {
        var stylesString = '';

        _.each(styles, function (style) {
            stylesString += '<link type="text/css" rel="stylesheet" href="' + style + '" />';
        });

        return stylesString;
    }

    function createIframeContent(options) {
        var stylesString = createIframeStyles(options.styles);

        return '' +
            '<html>' +
                '<head>' +
                    '<title>' + options.title + '</title>' +
                    stylesString +
                '</head>' +
                '<body>' +
                    options.content +
                '</body>' +
            '</html>';
    }

    function print(options) {
        var defaultOptions = {
                content: '',
                styles: undefined,
                title: ''
            },
            iframe,
            iframeContent;

        _.extend(defaultOptions, options);

        iframe = createIframe();
        iframeContent = createIframeContent(defaultOptions);

        iframe.contentWindow.document.open();
        iframe.contentWindow.document.write(iframeContent);
        iframe.contentWindow.document.close();
    }

    module.exports = {
        print: print
    };

}(jQuery));

},{}],2:[function(require,module,exports){
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

},{"./iframe-print":1,"./recipe-data":3}],3:[function(require,module,exports){
(function (global){
(function (global) {

    'use strict';

    var print = global.wp_recipe.print;

    module.exports = {
        print: print
    };

}(global));

}).call(this,typeof global !== "undefined" ? global : typeof self !== "undefined" ? self : typeof window !== "undefined" ? window : {})
},{}]},{},[1,2,3]);
