<?php

namespace common\enums;

class ContactUsStatus extends PhpEnum {

    const new_request = 1;
    const closed = 2;

    public static function Labels() {
        return [
            self::new_request => t('New Request'),
            self::closed => t('Closed'),
        ];
    }

    public static function LabelsStyle() {
        return [
            self::new_request => '<span class=" badge badge-sm" style="color: white;font-size: 17px; background-color: #43b957">'.t('New Request').'</span>',
            self::closed => '<span class=" badge badge-sm" style="color: white; font-size: 17px;background-color: #ff7600">'.t('Closed').'</span>',
        ];
    }

}
