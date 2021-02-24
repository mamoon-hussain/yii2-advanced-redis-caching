<?php

namespace api\modules;

use Yii;
use yii\helpers\ArrayHelper;
use webvimark\modules\UserManagement\UserManagementModule as BaseUserManagementModule;

class UserManagementModule extends BaseUserManagementModule
{
    protected $_defaultMailerOptions = [
        'from'=> '', // If empty it will be - [Yii::$app->params['adminEmail'] => Yii::$app->name . ' robot']

        'registrationFormViewFile'     => '/user/mail/registrationEmailConfirmation',
        'registrationCodeFormViewFile'     => '/user/mail/registrationCodeEmailConfirmation',
        'forgetPasswordCodeFormViewFile'     => '/user/mail/forgetPasswordCodeEmailConfirmation',
        'passwordRecoveryFormViewFile' => '/user/mail/passwordRecoveryMail',
        'confirmEmailFormViewFile'     => '/user/mail/emailConfirmationMail',
        'adminRegisterEmail'     => '/user/mail/adminRegisterEmail',
    ];
}
