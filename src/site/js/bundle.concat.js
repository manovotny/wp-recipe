(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
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

},{}]},{},[1]);
