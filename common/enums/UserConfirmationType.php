<?php

namespace common\enums;

class UserConfirmationType extends PhpEnum {

    const mobile_confirm = 1;
    const forgot_password = 2;
    const forgot_password_email = 3;

    public static function Labels() {
        return [
            self::mobile_confirm => \Yii::t('all', 'Mobile Confirm'),
            self::forgot_password => \Yii::t('all', 'Forgot Password'),
            self::forgot_password_email => \Yii::t('all', 'Forgot Password (sent by email)'),
        ];
    }

    public static function LabelsStyle() {
        return [
            self::mobile_confirm => '<span class=" badge badge-sm" style="color: white; background-color: #003e68">' .\Yii::t('all','Mobile Confirm').'</span>',
            self::forgot_password => '<span class="badge badge-sm" style="color: white; background-color: #003e68">' .\Yii::t('all','Forgot Password').'</span>',
            self::forgot_password_email => '<span class="badge badge-sm" style="color: white; background-color: #003e68">' .\Yii::t('all','Forgot Password (sent by email)').'</span>',
        ];
    }

}
