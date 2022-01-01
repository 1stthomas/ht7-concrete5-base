var ht7 = ht7 || {};
ht7.widgets = ht7.widgets || {};

/**
 * Idea from https://www.mediaevent.de/javascript/animation.html#optdown
 */
ht7.widgets.simple = {
    timer: {
        init: function(seconds, selector, callback) {
            this.variables.callback = callback;
            this.variables.seconds = seconds;
            this.variables.selector = selector;
        },
        helpers: {
            getMain: function() {
                return $(ht7.widgets.simple.timer.variables.selector);
            }
        },
        recCountdown: function(time) {
            time -= 1;
            ht7.widgets.simple.timer.update(time);

            if (time > 0) {
                ht7.widgets.simple.timer.variables.timeout = setTimeout(
                        ht7.widgets.simple.timer.recCountdown,
                        1000,
                        time);
            } else {
                if (typeof ht7.widgets.simple.timer.variables.callback === 'function') {
                    ht7.widgets.simple.timer.variables.callback();
                }

                return;
            }
        },
        start: function() {
            ht7.widgets.simple.timer.recCountdown(ht7.widgets.simple.timer.variables.seconds + 1);
        },
        stop: function() {
            console.log('timeout stop');
            if (ht7.widgets.simple.timer.variables.timeout !== undefined) {
                console.log('timeout stop - clear!!!');
                clearTimeout(ht7.widgets.simple.timer.variables.timeout);
                ht7.widgets.simple.timer.variables.timeout = undefined;
            }
        },
        update: function(time) {
            ht7.widgets.simple.timer.helpers.getMain()
                    .find('.time')
                    .html(time);
        },
        variables: {
            callback: undefined,
            seconds: undefined,
            selector: undefined,
            timeout: undefined
        }
    }
};
