(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

exports.parse = function (str) {
	if (typeof str !== 'string') {
		return {};
	}

	str = str.trim().replace(/^(\?|#)/, '');

	if (!str) {
		return {};
	}

	return str.trim().split('&').reduce(function (ret, param) {
		var parts = param.replace(/\+/g, ' ').split('=');
		var key = parts[0];
		var val = parts[1];

		key = decodeURIComponent(key);
		// missing `=` should be `null`:
		// http://w3.org/TR/2012/WD-url-20120524/#collect-url-parameters
		val = val === undefined ? null : decodeURIComponent(val);

		if (!ret.hasOwnProperty(key)) {
			ret[key] = val;
		} else if (Array.isArray(ret[key])) {
			ret[key].push(val);
		} else {
			ret[key] = [ret[key], val];
		}

		return ret;
	}, {});
};

exports.stringify = function (obj) {
	return obj ? Object.keys(obj).sort().map(function (key) {
		var val = obj[key];

		if (Array.isArray(val)) {
			return val.sort().map(function (val2) {
				return encodeURIComponent(key) + '=' + encodeURIComponent(val2);
			}).join('&');
		}

		return encodeURIComponent(key) + '=' + encodeURIComponent(val);
	}).join('&') : '';
};

},{}],2:[function(require,module,exports){
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

},{}],3:[function(require,module,exports){
(function ($) {

    'use strict';

    var data = require('./recipe-data'),
        iframePrint = require('./iframe-print'),
        queryString = require('query-string'),

        recipeSelector = '.recipe',
        recipeControlsSelector = '.recipe-controls';

    function printRecipe(event) {
        var $recipe = $(event.currentTarget).closest(recipeSelector).clone(),
            options;

        event.preventDefault();

        $recipe.find(recipeControlsSelector).remove();

        options = {
            content: $recipe.get(0).outerHTML,
            styles: data.print.styles,
            title: $recipe.find('.recipe-title').text()
        };

        iframePrint.print(options);
    }

    function init() {
        var $printRecipe = $('.recipe-print'),
            qs = queryString.parse(window.location.search.substring(1));

        $printRecipe.click(printRecipe);

        if (qs.hasOwnProperty('print-recipe')) {
            $printRecipe.click();
        }
    }

    init();

}(jQuery));

},{"./iframe-print":2,"./recipe-data":4,"query-string":1}],4:[function(require,module,exports){
(function (global){
(function (global) {

    'use strict';

    var print = global.wp_recipe.print;

    module.exports = {
        print: print
    };

}(global));

}).call(this,typeof global !== "undefined" ? global : typeof self !== "undefined" ? self : typeof window !== "undefined" ? window : {})
},{}]},{},[2,3,4]);
