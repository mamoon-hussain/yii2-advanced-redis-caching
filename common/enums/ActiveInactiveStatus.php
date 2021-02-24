<?php

namespace common\enums;

class ActiveInactiveStatus extends PhpEnum {

    const active = 1;
    const inactive = 0;
    const deleted = -1;

    public static function Labels() {
        return [
            self::active => t('Active'),
            self::inactive => t('Not Active'),
        ];
    }

    public static function LabelsStyle() {
        return [
            self::active => '<span class=" badge badge-sm" style="color: white;font-size: 17px; background-color: #43b957">'.t('Active').'</span>',
            self::inactive => '<span class=" badge badge-sm" style="color: white; font-size: 17px;background-color: #ff7600">'.t('Not Active').'</span>',
        ];
    }

}
