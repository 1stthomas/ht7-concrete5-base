<?php

return [
    'settings' => [
//        'fieldsets' => [
//            'styles' => tc('ht7_c5_base', 'Styles'),
//            'rows' => tc('ht7_c5_base', 'Row Appearance'),
//        ],
//        'libraryFilePathBase' => [
//            'label' => tc('ht7_c5_library', 'File path base'),
//            'title' => tc('ht7_c5_library', 'Base file path of the library books which will be prepend to the file specific path.'),
//            'type' => 'text',
//        ],
        'saveByAjax' => [
            'label' => tc('ht7_c5_library', 'Save these settings by AJAX request'),
            'nsValue' => 'settings.general',
            'tabId' => 'pane-general',
            'title' => tc('ht7_c5_library', 'If active the saving of these settings will be done by AJAX. This will probably not show the latest changes.'),
            'type' => 'boolean',
        ],
        'showBsTooltips' => [
            'label' => tc('ht7_c5_library', 'Show bootstrap tooltips'),
            'nsValue' => 'settings.general',
            'tabId' => 'pane-general',
            'title' => tc('ht7_c5_library', 'If active the tooltips will be displayed with the l&f of the bootstrap framework.'),
            'type' => 'boolean',
        ],
        'tableStyleBordered' => [
//            'fieldset' => 'rows',
            'label' => tc('ht7_c5_library', 'Settings with bordered l&f'),
            'nsValue' => 'settings.styles',
            'tabId' => 'pane-styles',
            'title' => tc('ht7_c5_library', 'Display the settings with bordered look & feel.'),
            'type' => 'boolean',
        ],
        'tableStyleStripped' => [
//            'fieldset' => 'rows',
            'label' => tc('ht7_c5_library', 'Settings with stripped l&f'),
            'nsValue' => 'settings.styles',
            'tabId' => 'pane-styles',
            'title' => tc('ht7_c5_library', 'Display the settings with stripped look & feel.'),
            'type' => 'boolean',
        ],
        'tableRowHeightMin' => [
            'attributes' => [
                'max' => 50,
                'min' => 20,
                'step' => 1,
            ],
//            'fieldset' => 'styles',
            'label' => tc('ht7_c5_library', 'Min Height of these rows'),
            'nsValue' => 'settings.styles',
            'tabId' => 'pane-styles',
            'title' => tc('ht7_c5_library', 'This is the min height in pixels of these settings rows.'),
            'type' => 'number',
        ],
        'tablePaddingTop' => [
            'attributes' => [
                'max' => 10,
                'min' => 0,
                'step' => 1,
            ],
//            'fieldset' => 'styles',
            'label' => tc('ht7_c5_library', 'Padding top of these rows'),
            'nsValue' => 'settings.styles',
            'tabId' => 'pane-styles',
            'title' => tc('ht7_c5_library', 'This is the padding top in pixels of these settings rows.'),
            'type' => 'number',
        ],
        'tablePaddingBottom' => [
            'attributes' => [
                'max' => 10,
                'min' => 0,
                'step' => 1,
            ],
//            'fieldset' => 'styles',
            'label' => tc('ht7_c5_library', 'Padding bottom of these rows'),
            'nsValue' => 'settings.styles',
            'tabId' => 'pane-styles',
            'title' => tc('ht7_c5_library', 'This is the padding bottom in pixels of these settings rows.'),
            'type' => 'number',
        ],
    ],
];
