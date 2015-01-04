(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
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

},{"./recipe-data":2}],2:[function(require,module,exports){
(function (global){
(function (global) {

    'use strict';

    var print = global.wp_recipe.print;

    module.exports = {
        print: print
    };

}(global));

}).call(this,typeof global !== "undefined" ? global : typeof self !== "undefined" ? self : typeof window !== "undefined" ? window : {})
},{}]},{},[1,2]);
