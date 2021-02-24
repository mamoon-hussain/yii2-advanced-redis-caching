<?php

namespace common\enums;

class ClassPeriod extends PhpEnum {

    const noon_period = 1;
    const afternoon_period = 2;

    public static function Labels() {
        return [
            self::noon_period => t('Morning'),
            self::afternoon_period => t('Afternoon'),
        ];
    }

    public static function LabelsStyle() {
        return [
            self::noon_period => '<span class=" badge badge-sm" style="color: white;font-size: 17px; background-color: #43b957">'.t('Morning').'</span>',
            self::afternoon_period => '<span class=" badge badge-sm" style="color: white; font-size: 17px;background-color: #ff7600">'.t('Afternoon').'</span>',
        ];
    }

}
