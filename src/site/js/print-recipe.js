(function ($) {

    'use strict';

    function printRecipe() {
        window.print();
    }

    function init() {
        $('.print').on('click', printRecipe);
    }

    init();

}(jQuery));
