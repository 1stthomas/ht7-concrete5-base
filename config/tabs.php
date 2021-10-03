<?php

return [
    'settings' => [
        'items' => [
            [
                'content' => 'settings.general',
                'id' => 'pane-general',
                'name' => tc('ht7_c5_library', 'General'),
            ],
            [
                'content' => 'settings.styles',
                'id' => 'pane-styles',
                'name' => tc('ht7_c5_library', 'Look&Feel'),
                'selected' => true,
            ],
        ],
        'markup' => [
            'content' => [
                'container' => [
                    'attributes' => [
                        'class' => 'ccm-tab-content',
                        'id' => 'ccm-tab-content'
                    ],
                    'tag' => 'article',
                ]
            ]
        ]
    ],
];
