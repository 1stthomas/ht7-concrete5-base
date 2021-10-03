var ht7 = ht7 || {};
ht7.widgets = ht7.widgets || {};

ht7.widgets.c5 = {
    notification: {
        /**
         * Show a concrete5 notification.
         *
         * @param   {string}    title       The title of the c5 notification.
         * @param   {string}    msg         The content of the c5
         *                                  notification.
         * @param   {string}    alertType   The kind of the c5 notification.
         *                                  Supported types: 'success',
         *                                  'error', null.
         */
        add: function(title, msg, alertType) {
            const parameters = {
                title: title,
                message: msg
            };

            if (alertType === 'success') {
                ConcreteAlert.notify(parameters);
            } else if (alertType === 'error') {
                ConcreteAlert.error(parameters);
            } else {
                ConcreteAlert.info(parameters);
            }
        }
    }
};
