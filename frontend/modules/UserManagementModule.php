<?php

namespace frontend\modules;

use Yii;
use yii\helpers\ArrayHelper;
use webvimark\modules\UserManagement\UserManagementModule as BaseUserManagementModule;

class UserManagementModule extends BaseUserManagementModule
{
    public $controllerNamespace = 'frontend\controllers\user';

    public $registrationFormClass = 'frontend\models\user\forms\RegistrationForm';

    protected $_defaultMailerOptions = [
        'from'=>'', // If empty it will be - [Yii::$app->params['adminEmail'] => Yii::$app->name . ' robot']

        'registrationFormViewFile'     => '/mail/registrationEmailConfirmation',
        'passwordRecoveryFormViewFile' => '/mail/passwordRecoveryMail',
        'confirmEmailFormViewFile'     => '/user/mail/emailConfirmationMail',
        'invoicePasswordRecoveryFormViewFile'     => '/user/mail/invoice_pass_mail',
    ];
}
