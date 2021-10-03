var ht7 = ht7 || {};
ht7.tools = ht7.tools || {};

ht7.tools.settings = {
    addEventListeners: function() {
        this.variables.$main.find('input[type="reset"]').on('click', this.onReset);
        this.variables.$main.find('#ht7-tools-settings-save').on('click', this.onSave);
    },
    attributes: {
        hasChanged: function($el) {
            const type = ht7.tools.settings.attributes.getType($el);

            if (type === 'checkbox') {
                return ($el.prop('checked') ? 1 : 0) !== Number($el.data('value-initial'));
            } else if (type === 'number') {
                return Number($el.val()) !== Number($el.data('value-initial'));
            } else if ($.inArray(type, ['email', 'number', 'text'])) {
                return $el.val() !== $el.data('value-initial');
            }

            return false;
        },
        getType: function($el) {
            if ($el.prop('tagName') === 'INPUT') {
                return $el.prop('type');
            } else {
                return $el.prop('tagName').toLowerCase();
            }
        }
    },
    init: function(selectorMain) {
        const $main = $(selectorMain);
        this.variables.$main = $main;
        this.variables.$formSettings = $main.find('.settings-form');

        this.addEventListeners();

        if ($main.data('bs-tooltips')) {
            $main.find('[data-toggle="tooltip"]').tooltip();
        }
    },
    onReset: function(e) {
        e.preventDefault();

        window.location.href = $(e.target).data('url');
    },
    onSave: function(e) {
        e.preventDefault();

        const $els = ht7.tools.settings.variables.$formSettings.find('[data-value-initial]');
        const count = $els.length;

        ht7.widgets.bodyoverlay.show();

        for (let i = 0; i < count; i++) {
            const $el = $($els.get(i));

            if (!ht7.tools.settings.attributes.hasChanged($el)) {
                // Unchanged values will not be sent to the server.
                $el.prop('disabled', true).addClass('ht7-to-enable');
            } else if (ht7.tools.settings.attributes.getType($el) === 'checkbox') {
                // Create a hidden field to send also zeros (unchecked) states
                // to the server.
                const $hidden = $('<input type="hidden" class="ht7-to-remove" name="' + $el.attr('id') + '">');
                $hidden.attr('value', ($el.get(0).checked ? 1 : 0));
                $el.parent().append($hidden);
                // "remove" the checkbox fromt the form.
                $el.attr('id', $el.attr('id') + '1');
                $el.prop('disabled', true);
            }
        }

        if (ht7.tools.settings.variables.$main.data('is-saved-by-ajax')) {
            // Get the form data.
            const data = ht7.tools.settings.variables.$formSettings.serializeArray();
            console.log(data);
            // Enable all previously disabled form elements.
            $('.ht7-tools-settings .settings-form .ht7-to-enable').prop('disabled', false);

            $('.ht7-tools-settings .ht7-to-remove').each(function() {
                const $el = $(this);

                // Reset the original attributes.
                $el.parent().find('#' + $el.attr('name') + '1')
                        .attr('id', $el.attr('name'))
                        .prop('disabled', false);
                // Remove the helper element.
                $el.remove();
            });

            $.ajax({
                data: data,
                method: "POST",
                url: ht7.tools.settings.variables.$formSettings.attr('action')
            }).done(function(data) {
                // Show a c5 notification with the response from the server.
                let notificationType = 'info';
                let msg;

                if (data.count_updated > 0) {
                    notificationType = 'success';
                }
                if (data.success === undefined) {
                    msg = data.message;
                } else {
                    msg = data.success;
                }

                ht7.widgets.c5.notification
                        .add('Settings Updated', msg, notificationType);
            }).fail(function(data) {

            }).always(function() {
                ht7.widgets.bodyoverlay.hide();
            });

        } else {
            ht7.tools.settings.variables.$formSettings.submit();
        }
    },
    variables: {
        $main: undefined,
        $formSettings: undefined
    }
};
