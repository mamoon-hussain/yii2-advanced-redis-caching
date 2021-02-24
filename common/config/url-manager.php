<?php

return [
    'components' => [
        'urlManager' => [
            'class' => '\codemix\localeurls\UrlManager',
            'languages' => ['ar', 'en'],
            'ignoreLanguageUrlPatterns' => [
                '#^ads/#' => '#^ads/#',
            ],
                    'enablePrettyUrl' => true,
//                    'showScriptName' => true,
//
//            'rules' => [
//                'GET,HEAD institute' => 'institute/index',
//            ],

            'enablePrettyUrl' => true,
//            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => array(
                '<path>/<controller>/<action>/<id>' => '<path>/<controller>/<action>',
//                '<path>/<controller>/<action>/<d1>/<d2>/<d3>/' => '<path>/<controller>/<action>',
            ),
        ],
        'urlManagerBackend' => [
            'class' => '\codemix\localeurls\UrlManager',
            'languages' => ['de', 'en'],
            'ignoreLanguageUrlPatterns' => [
                '#^ads/#' => '#^ads/#',
            ],
//                    'enablePrettyUrl' => true,
//                    'showScriptName' => true,
//
            'rules' => [
            ],
        ],
//                'urlManagerFrontend' => [
//                    'class' => 'yii\web\urlManager',
//                    'baseUrl' => '/clinic/frontend/web',
//                    'enablePrettyUrl' => true,
//                    'showScriptName' => true,
//                    'rules' => [
//                        '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
//                        '<controller:\w+>/cat/<slug:[\w-]+>' => '<controller>/cat',
//                        '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
//                        '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
//                        '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
//                        '<module:\w+><controller:\w+>/<action:update|delete>/<id:\d+>' => '<module>/<controller>/<action>',
//                    ],
//                ],
//                'urlManagerBackend' => [
//                    'class' => 'yii\web\urlManager',
//                    'baseUrl' => '/clinic/backend/web',
//                    'enablePrettyUrl' => true,
//                    'showScriptName' => true,
//                    'rules' => [
//                        '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
//                        '<controller:\w+>/cat/<slug:[\w-]+>' => '<controller>/cat',
//                        '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
//                        '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
//                        '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
//                        '<module:\w+><controller:\w+>/<action:update|delete>/<id:\d+>' => '<module>/<controller>/<action>',
//                    ],
//                ],
    ]
];
