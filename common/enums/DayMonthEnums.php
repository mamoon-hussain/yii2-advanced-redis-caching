<?php

namespace common\enums;

class DayMonthEnums extends PhpEnum {

    const per_day = 1;

    public static function Labels() {
        return [
            self::per_day => t('Per Day'),
        ];
    }

    public static function LabelsStyle() {
        return [
            self::per_day => '<span class=" badge badge-sm" style="color: white;font-size: 17px; background-color: #43b957">'.t('Per Day').'</span>',
        ];
    }

}
