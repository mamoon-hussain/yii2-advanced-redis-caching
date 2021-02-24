<?php

namespace common\models;

use common\enums\Constents;
use common\enums\UserConfirmationType;
use Ramsey\Uuid\Uuid;
use webvimark\modules\UserManagement\models\VAdmin;
use webvimark\modules\UserManagement\models\VUserMobileEmail;
use Yii;
use yii\imagine\Image;

class UserMobileEmail extends VUserMobileEmail {

    public function rules()
    {
        return [
            [['user_id', 'confirm_code'], 'required'],
            [['user_id', 'is_confirmed', 'is_primary'], 'integer'],
        ];
    }

    public function sendConfirmationCodePhone($type) {
//add Send SMS Here

        return true;

    }

}
