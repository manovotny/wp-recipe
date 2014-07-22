(function (global) {
    'use strict';

    function namespace(ns, api) {
        var object = this,
            levels = ns.split('.'),
            levelCount = levels.length,
            i;

        for (i = 0; i < levelCount; i += 1) {
            if (object[levels[i]] === undefined) {
                if (i === levelCount - 1) {
                    object[levels[i]] = api || {};
                } else {
                    object[levels[i]] = {};
                }
            }

            object = object[levels[i]];
        }

        if (api.init) {
            api.init();
        }
    }

    if (undefined === global.wp) {
        global.wp = {
            namespace: namespace
        };
    } else if (undefined === global.wp['namespace']) {
        global.wp['namespace'] = namespace;
    }

}(this));