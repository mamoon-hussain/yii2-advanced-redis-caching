<?php

return [
    'components' => [
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => false, //set this property to false to send mails to real email addresses
            //comment the following array to send mail using php's mail function
            //  'transport' => [
            //     'class' => 'Swift_SmtpTransport',
            //     'host' => 'smtp.gmail.com',
            //     'username' => 'marketingkw.site@gmail.com',
            //     'password' => 'ypcgsjarrvkzsfcj',
            //     'port' => '587',
            //     'encryption' => 'tls',
            // ],
        ],
    ],
];
