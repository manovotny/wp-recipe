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
