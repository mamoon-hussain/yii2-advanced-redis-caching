<?php

namespace common\enums;

class YesNoEnum extends PhpEnum {

    const yes = 1;
    const no = 0;

    public static function Labels() {
        return [
            self::yes => \Yii::t('all', 'Yes'),
            self::no => \Yii::t('all', 'No'),
        ];
    }

    public static function LabelsStyle() {
        return [
            self::yes => '<span class=" badge badge-sm" style="color: white; background-color: #43b957">'.\Yii::t('all','Yes').'</span>',
            self::no => '<span class=" badge badge-sm" style="color: white; background-color: #ff7600">'.\Yii::t('all','No').'</span>',
        ];
    }

}
