var ht7 = ht7 || {};
ht7.widgets = ht7.widgets || {};

ht7.widgets.bodyoverlay = {
    helpers: function() {

    },
    hide: function() {
        $(this.parameters.selector.type + this.parameters.selector.name).hide();
    },
    parameters: {
        selector: {
            name: 'ht7-body-overlay',
            type: '.'
        }
    },
    show: function() {
        $(this.parameters.selector.type + this.parameters.selector.name).show();
    }
};
