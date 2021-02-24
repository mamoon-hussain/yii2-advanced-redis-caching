<?php

namespace common\enums;

class NotificationType extends PhpEnum
{
    const new_request = 1;
    const request_answer = 2;

    public static function Labels($lang = null)
    {
        return [
            self::new_request => \Yii::t('all', 'New Request', [], $lang),
            self::request_answer => \Yii::t('all', 'Request Answer', [], $lang),
        ];
    }

    public static function UserNotifications($lang = null)
    {
        return [
            self::request_answer => \Yii::t('all', 'Request Answer', [], $lang),
        ];
    }

    public static function AdminNotifications($lang = null)
    {
        return [
            self::new_request => \Yii::t('all', 'New Request', [], $lang),
        ];
    }

}
