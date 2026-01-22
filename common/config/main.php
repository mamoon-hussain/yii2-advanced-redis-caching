<?php

define('UsersModelClassName', '\common\models\User');
define('AdminsModelClassName', '\common\models\Admin');
$modulesDir = dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'modules';
require_once dirname(__FILE__) . '/../utils/php_includes.php';
require_once dirname(__FILE__).'/../../vendor'.DIRECTORY_SEPARATOR.'ezyang'.DIRECTORY_SEPARATOR.'htmlpurifier'.DIRECTORY_SEPARATOR.'library'.DIRECTORY_SEPARATOR.'HTMLPurifier.auto.php';
return array_merge_recursive(
    require('db.php'),
    require( 'mail.php'),
    require( 'users.php'),
    require( 'url-manager.php'),
    require( 'aliases.php'),
    [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
//    'language' => 'en',
    'timeZone' => 'Asia/Damascus',
    'name' => 'Painter',
    'components' => [
        'i18n' => [
            'translations' => [
                'api*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
                'frontend*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
                'backend*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
                'model*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
                'all' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
                'register' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
                'audit' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
                'yii2mod.comments' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@yii2mod/comments/messages',
                ],
            ],
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@vendor/webvimark/module-user-management/views' => '@frontend/views/user/',
                ],
            ],
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=YOUR_DATABASE_NAME',
            'username' => 'YOUR_USERNAME',
            'password' => 'YOUR_PASSWORD',
            'charset' => 'utf8',
            'on afterOpen' => function($event) {
                // $event->sender refers to the DB connection
                $event->sender->createCommand("SET SQL_BIG_SELECTS = 1")->execute();
            }
        ],

        'cache' => [
            'class' => 'yii\redis\Cache',
            'redis' => 'redis',
        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => 'localhost',
            'port' => 6379,
            'database' => 0,
        ],
//        'cache' => [
//            'class' => 'yii\caching\FileCache',
//        ],
        'session' => [
            'class' => 'yii\redis\Session',
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'authUrl' => 'https://www.facebook.com/dialog/oauth?display=popup',
                    'clientId' => '2566383410265043----',
                    'clientSecret' => '0e362bf3ea10e7e57d99cc34dfb3e9f2----',
                    'attributeNames' => ['name', 'email', 'first_name', 'last_name', 'id'],
                    'scope' => ['manage_pages', 'publish_pages', 'pages_messaging']
                ],
            ],
        ],
        'fcm' => [
            'class' => 'understeam\fcm\Client',
            'apiKey' => 'AAAAN2s-bZU:APA91bFiAyOfHlXe09XB6txGoPRWNaJ4ao8JghwktYUrag4u7wITMMosUKGxFsUL9LDADVhoFtU5HEQqqMktWCWvC0VT1ZHZ-XOJxC7PG4UNlBn6grmvr_iZzobpniDx84WVHwBRgg0C', // Server API Key (you can get it here: https://firebase.google.com/docs/server/setup#prerequisites)
        ],
    ],

    'bootstrap' => [
        'gii',
    ],
    'modules' => [
//        'audit' => 'bedezign\yii2\audit\Audit',
//        'review' => [
//            'class' => 'fgh151\review\Module',
////            'as access' => [
////                'class' => 'yii\filters\AccessControl',
////                'rules' => [
////                    [
////                        'allow' => true,
////                        'roles' => ['admin'],
////                    ]
////                ]
////            ]
//        ],
//        'comment' => [
//            'class' => 'yii2mod\comments\Module',
//        ],
    ],

]);
