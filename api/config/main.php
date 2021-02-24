<?php

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'api\controllers',
    'components' => [
        'user' => [
            'class' => 'webvimark\modules\UserManagement\components\UserConfig',
        ],
        'session' => [
            'name' => 'PHPFRONTSESSID',
            'savePath' => sys_get_temp_dir(),
        ],
        'request' => [
            'class' => 'common\components\Request',
            'web' => '/api/web',
            'adminUrl' => '/api',
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'MNZgQNwjtgZsGNnMnsQo',
            'csrfParam' => '_apiCSRF',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            // web error handler
            'errorAction' => 'service/error',
//            'class' => 'bedezign\yii2\audit\ErrorHandler',
            'class' => 'yii\web\ErrorHandler',
            // console error handler
            //'class' => '\bedezign\yii2\audit\components\console\ErrorHandler',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@vendor/webvimark/module-user-management/views' => '@api/views/user/',
                ],
            ],
        ],
//        'response' => [
//            'class' => 'yii\web\Response',
//            'on beforeSend' => function ($event) {
//
//                if (in_array(Yii::$app->request->url, ['/virln/en/site/docs', '/virln/en/site/json-schema'])) {
//                    return;
//                }
//                $response = $event->sender;
//                if ($response->isSuccessful) {
//                    $response->data = [
//                        'isOk' => true,
//                        'result' => $response->data,
//                        'message' => [
//                        ]
//                    ];
//                } else {
//                    if(isset($response->data)){
//                        $response->data = [
//                            'isOk' => false,
//                            'result' => null,
//                            'message' => [
//                                'type' => isset($response->data['name']) ? $response->data['name'] : '',
//                                'code' => isset($response->data['status']) ? $response->data['status'] : '',
//                                'content' => isset($response->data['message']) ? $response->data['message'] : '',
//                            ]
//                        ];
//                    }
//                }
//                $response->statusCode = 200;
//
//                exit();
//            },
//        ],
    ],
    'modules' => [
        'user' => [
            'class' => 'api\modules\UserManagementModule',
            'registrationFormClass' => 'models\user\forms\VRegistrationForm',
            'useEmailAsLogin' => true,
            'emailConfirmationRequired' => false,
            'mobileConfirmationRequired' => false,
            'enableRegistration' => true,
            // Here you can set your handler to change layout for any controller or action
            // Tip: you can use this event in any module
            'on beforeAction' => function(yii\base\ActionEvent $event) {
//                $event->action->uniqueId =='api/auth/login';
            },
            'on afterRegistration' => function(webvimark\modules\UserManagement\components\UserAuthEvent $event) {
                return false;
                // Here you can do your own stuff like assign roles, send emails and so on
            },
        ],
    ],

    'params' => $params,
];
