(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
(function ($) {

    'use strict';

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
            iframe;

        $recipe.find('.recipe-controls').remove();

        $iframe = $('iframe#printable-iframe');

        if (!$iframe.length) {
            $iframe = $('<iframe id="' + printableIframe + '"></iframe>');

            $('body').append($iframe);
        }

        iframe = $iframe.get(0);

        iframe.onload = iframeLoaded;

        content =
            '<html>' +
                '<head>' +
                    '<title>' + 'asdf' + '</title>' +
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
        $('.recipe .print').on('click', printRecipe);
    }

    init();

}(jQuery));

},{}]},{},[1]);
