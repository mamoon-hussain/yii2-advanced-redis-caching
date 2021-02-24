<?php

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=artzona_db',
            'username' => 'artzona_user',
            'password' => '!Ep3qOSTbTL0',
            'charset' => 'utf8',
            'on afterOpen' => function($event) {
                // $event->sender refers to the DB connection
                $event->sender->createCommand("SET SQL_BIG_SELECTS = 1")->execute();
            }
        ],
    ],
];