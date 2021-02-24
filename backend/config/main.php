<?php

$params = array_merge(
        require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/../../common/config/params-local.php'), require(__DIR__ . '/params.php'), require(__DIR__ . '/params-local.php')
);
return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'components' => [
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js'=>[]
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => []
                ]
            ]
        ],



        'user' => [
            'class' => 'backend\config\AdminConfig',
        ],
        'session' => [
            'name' => 'PHPBACKSESSID',
            'savePath' => sys_get_temp_dir(),
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'OKEUJcDCHklHteieKcDp',
            'csrfParam' => '_backendCSRF',
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@backend/modules/views' => '@backend/views/user/',
                ],
            ],
        ],
        'request' => [
            'class' => 'common\components\Request',
            'web' => '/backend/web',
            'adminUrl' => '/admin'
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],

//        'errorHandler' => [
//            'errorAction' => 'site/error',
//        ],
//        'errorHandler' => [
            // web error handler
//            'class' => 'bedezign\yii2\audit\components\web\ErrorHandler',
            // console error handler
            //'class' => '\bedezign\yii2\audit\components\console\ErrorHandler',
//        ],
        'errorHandler' => [
            // web error handler
            'errorAction' => 'site/error',
//            'class' => 'bedezign\yii2\audit\components\web\ErrorHandler',
//            'class' => 'common\modules\errorhandler\ErrorHandler',
            'class' => 'yii\web\ErrorHandler',
            // console error handler
            //'class' => '\bedezign\yii2\audit\components\console\ErrorHandler',
        ],
    ],
    'modules' => [
        'gii' => [
            'class' => 'yii\gii\Module', //adding gii module
            'allowedIPs' => ['127.0.0.1', '::1']  //allowing ip's
        ],
        'user' => [
            'class' => 'backend\modules\UserManagementModule',
            'registrationFormClass' => 'models\user\forms\VRegistrationForm',
            'useEmailAsLogin' => true,
            'emailConfirmationRequired' => false,
            'mobileConfirmationRequired' => false,
            'enableRegistration' => true,
            // Here you can set your handler to change layout for any controller or action
            // Tip: you can use this event in any module
            'on beforeAction' => function(yii\base\ActionEvent $event) {
//                $event->action->uniqueId =='backend/auth/login';
            },
            'on afterRegistration' => function(webvimark\modules\UserManagement\components\UserAuthEvent $event) {
                return false;
                // Here you can do your own stuff like assign roles, send emails and so on
            },
        ],
    ],
    'params' => $params,
];
