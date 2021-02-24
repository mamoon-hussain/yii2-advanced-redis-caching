<?php

namespace frontend\models\user\forms;

use borales\extensions\phoneInput\PhoneInputValidator;
use common\enums\UserConfirmationType;
use common\models\User;
use common\models\UserMobileEmail;
use common\services\UserService;
use Yii;

class ChangeOwnPasswordForm extends \webvimark\modules\UserManagement\models\forms\ChangeOwnPasswordForm {

    public $phone;
    public $code;

    public function rules()
    {
        $p = parent::rules();
        $p[] = [['phone', 'code'], 'safe'];
        return $p;
    }

    public function attributeLabels()
    {
        $p = parent::attributeLabels();
        $p['phone'] = t('Phone');
        $p['code'] = t('Code');
        return $p;
    }



}
