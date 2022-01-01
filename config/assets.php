<?php

return [
    'group' => [
        'ht7-widgets/body-overlay' => [
            ['css', 'ht7-widgets/body-overlay'],
            ['javascript', 'ht7-widgets/body-overlay']
        ],
        'ht7-widgets/simple' => [
            ['css', 'ht7-widgets/simple'],
            ['javascript', 'ht7-widgets/simple']
        ],
        'ht7-tools/settings' => [
            ['css', 'ht7-tools/settings'],
            ['javascript', 'ht7-tools/settings']
        ]
    ],
    'single' => [
        [
            'css',
            'ht7-tools/settings',
            'css/ht7.tools.settings.css',
            ['version' => '0.0.1', 'minify' => true, 'combine' => true]
        ],
        [
            'css',
            'ht7-widgets/status-toggle',
            'css/ht7.widgets.statustoggle.css',
            ['version' => '0.0.1', 'minify' => true, 'combine' => true]
        ],
        [
            'css',
            'ht7-widgets/body-overlay',
            'css/ht7.widgets.bodyoverlay.css',
            ['version' => '0.0.1', 'minify' => true, 'combine' => true],
        ],
        [
            'css',
            'ht7-widgets/simple',
            'css/ht7.widgets.simple.css',
            ['version' => '0.0.1', 'minify' => true, 'combine' => true],
        ],
        [
            'javascript',
            'ht7-extenders',
            'js/ht7.extenders.js',
            ['version' => '0.0.1', 'minify' => true, 'combine' => true],
        ],
        [
            'javascript',
            'ht7-tools/settings',
            'js/ht7.tools.settings.js',
            ['version' => '0.0.1', 'minify' => true, 'combine' => true]
        ],
        [
            'javascript',
            'ht7-widgets/body-overlay',
            'js/ht7.widgets.bodyoverlay.js',
            ['version' => '0.0.1', 'minify' => true, 'combine' => true]
        ],
        [
            'javascript',
            'ht7-widgets/simple',
            'js/ht7.widgets.simple.js',
            ['version' => '0.0.1', 'minify' => true, 'combine' => true],
        ],
        [
            'javascript',
            'ht7-widgets/concrete5',
            'js/ht7.widgets.c5.js',
            ['version' => '0.0.1', 'minify' => true, 'combine' => true],
        ]
    ]
];
