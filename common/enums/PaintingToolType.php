<?php

namespace common\enums;

class PaintingToolType extends PhpEnum {

    const painting = 1;
    const tool = 2;

    public static function Labels() {
        return [
            self::painting => t('Painting'),
            self::tool => t('Tool'),
        ];
    }

    public static function LabelsStyle() {
        return [
            self::painting => '<span class=" badge badge-sm" style="color: white;font-size: 17px; background-color: #43b957">'.t('Painting').'</span>',
            self::tool => '<span class=" badge badge-sm" style="color: white; font-size: 17px;background-color: #ff7600">'.t('Tool').'</span>',
        ];
    }

}
