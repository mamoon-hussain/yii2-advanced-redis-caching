<?php

namespace common\enums;

class RequestTypes extends PhpEnum {

    const product = 1;
    const place = 2;



    public static function Labels() {
        return [
            self::product => t('Product'),
            self::place => t('Place'),
        ];
    }

    public static function LabelsStyle() {
        return [
            self::product => '<span class=" badge badge-sm" style="color: white;font-size: 17px; background-color: #b97d39">' .t('Product').'</span>',
            self::place => '<span class=" badge badge-sm" style="color: white; font-size: 17px;background-color: #5d71ff">' .t('Place').'</span>',
        ];
    }

}
