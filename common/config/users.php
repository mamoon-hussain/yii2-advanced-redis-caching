<?php

return [
//    'components' => [
//        'user' => [
//            'class' => 'webvimark\modules\UserManagement\components\UserConfig',
//            // Comment this if you don't want to record user logins
////            'on afterLogin' => function($event) {
////                \webvimark\modules\UserManagement\models\UserVisitLog::newVisitor($event->identity->id);
////            }
//        ],
//    ],
    'modules' => [
//        'user-management' => [
//            'class' => 'webvimark\modules\UserManagement\UserManagementModule',
//            'registrationFormClass' => 'models\forms\VRegistrationForm',
//            'useEmailAsLogin' => false,
//            'emailConfirmationRequired' => false,
//            'mobileConfirmationRequired' => false,
////            'controllerNamespace' => 'webvimark\modules\UserManagement\zcontrollers',
//            'enableRegistration' => true,
//            // Here you can set your handler to change layout for any controller or action
//            // Tip: you can use this event in any module
//            'on beforeAction' => function(yii\base\ActionEvent $event) {
//                if ($event->action->uniqueId == 'user-management/auth/login') {
//                    $event->action->controller->layout = 'loginLayout.php';
//                }
//            },
//            'on afterRegistration' => function(webvimark\modules\UserManagement\components\UserAuthEvent $event) {
//                return false;
//                // Here you can do your own stuff like assign roles, send emails and so on
//            },
//        ],
    ],
];
