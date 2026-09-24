(function ($) {
    'use strict';

    function showFlashMessages() {
        if (typeof alertify === 'undefined' || !window.__flashMessages || !window.__flashMessages.length) {
            return;
        }

        alertify.set('notifier', 'position', 'top-right');
        alertify.set('notifier', 'delay', 5);

        window.__flashMessages.forEach(function (flash) {
            var type = flash.type || 'message';
            var message = flash.message || '';

            if (message === '') {
                return;
            }

            alertify.notify(message, type, 5);
        });

        window.__flashMessages = [];
    }

    function loadAlertify(callback) {
        if (typeof alertify !== 'undefined') {
            callback();
            return;
        }

        var script = document.createElement('script');
        script.src = 'https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js';
        script.onload = callback;
        document.body.appendChild(script);
    }

    $(function () {
        if (!window.__flashMessages || !window.__flashMessages.length) {
            return;
        }

        loadAlertify(showFlashMessages);
    });
}(jQuery));
