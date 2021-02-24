<?php

namespace common\enums;

class RequestEnums extends PhpEnum {

    const painting = 1;
    const tool = 2;
    const hall = 3;
    const package = 4;
    const course = 5;


    public static function Labels() {
        return [
            self::painting => t('Painting'),
            self::tool => t('Tool'),
            self::hall => t('Class'),
            self::package => t('Art Table'),
            self::course => t('Course'),
        ];
    }

    public static function LabelsStyle() {
        return [
            self::painting => '<span class=" badge badge-sm" style="color: white;font-size: 17px; background-color: #b97d39">' .t('Painting').'</span>',
            self::tool => '<span class=" badge badge-sm" style="color: white; font-size: 17px;background-color: #5d71ff">' .t('Tool').'</span>',
            self::hall => '<span class=" badge badge-sm" style="color: white; font-size: 17px;background-color: #53ff43">' .t('Class').'</span>',
            self::package => '<span class=" badge badge-sm" style="color: white; font-size: 17px;background-color: #ffdc00">' .t('Art Table').'</span>',
            self::course => '<span class=" badge badge-sm" style="color: white; font-size: 17px;background-color: #ff3025">' .t('Course').'</span>',
        ];
    }

}
