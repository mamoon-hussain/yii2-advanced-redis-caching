<?php

namespace common\enums;

class LoginApiEnum extends PhpEnum {

    const accepted = 1;
    const invalid_password = 2; //login failed
    const not_confirmed = 3; //needs phone confirmation
    const banned = 4; //lockout by system admin
    const not_active = 5; //account not active yet
    const not_found = 6; //account not found

    public static function Labels($lang = null) {
        return [
            self::accepted => \Yii::t('all', 'Login Accepted', [], $lang),
            self::invalid_password => \Yii::t('all', 'Invalid Password', [], $lang),
            self::not_confirmed => \Yii::t('all', 'Account not Confirmed', [], $lang),
            self::banned => \Yii::t('all', 'User is BANNED', [], $lang),
            self::not_active => \Yii::t('all', 'Account not Active', [], $lang),
            self::not_found => \Yii::t('all', 'User not found', [], $lang),
        ];
    }


}
