<?php

namespace common\enums;

class PlaceType extends PhpEnum {

    const hall = 3;
    const package = 4;
    const course = 5;

    public static function Labels() {
        return [
            self::course => t('Course'),
            self::hall => t('Hall'),
            self::package => t('Package'),
        ];
    }

    public static function LabelsStyle() {
        return [
            self::course => '<span class=" badge badge-sm" style="color: white;font-size: 17px; background-color: #43b957">'.t('Course').'</span>',
            self::hall => '<span class=" badge badge-sm" style="color: white; font-size: 17px;background-color: #ff7600">'.t('Hall').'</span>',
            self::package => '<span class=" badge badge-sm" style="color: white; font-size: 17px;background-color: #ff7600">'.t('Package').'</span>',
        ];
    }

}
