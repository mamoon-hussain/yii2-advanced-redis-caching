<?php

namespace common\enums;
use yii\helpers\Html;

class SentNotsentStatus extends PhpEnum
{

    const sent = 1;
    const notSent = 0;
    const notification_topic_name = 'all';

    public static function Labels()
    {
        return [
            self::sent => t('Sent'),
            self::notSent => t('Not Sent'),
        ];
    }

    public static function LabelsStyle()
    {
        return [
            self::sent => '<span class=" badge badge-sm" style="color: white;font-size: 17px; background-color: #43b957">' . t('Sent') . '</span>',
            self::notSent => '<span class=" badge badge-sm" style="color: white; font-size: 17px;background-color: #ff7600">' . t('Not Sent') .'</span>',
        ];
    }
}

