<?php

namespace common\enums;

class CourseType extends PhpEnum {

    const direct = 1;
    const online = 0;

    public static function Labels() {
        return [
            self::direct => t('Direct'),
            self::online => t('Online'),
        ];
    }

    public static function LabelsStyle() {
        return [
            self::direct => '<span class=" badge badge-sm" style="color: white;font-size: 17px; background-color: #43b957">'.t('Direct').'</span>',
            self::online => '<span class=" badge badge-sm" style="color: white; font-size: 17px;background-color: #ff7600">'.t('Online').'</span>',
        ];
    }

}
