<?php

namespace common\enums;

class PublishStatus extends PhpEnum {

    const published = 1;
    const not_published = 0;
    const deleted = -1;

    public static function Labels() {
        return [
            self::published => t( 'Published'),
            self::not_published => t('Not Published'),
        ];
    }

    public static function AllLabels() {
        return [
            self::published => t( 'Published'),
            self::not_published => t( 'Not Published'),
            self::deleted => t( 'Deleted'),
        ];
    }

    public static function LabelsStyle() {
        return [
            self::published => '<span class=" badge badge-sm" style="color: white;font-size: 17px; background-color: #00FF00">'.t('Published').'</span>',
            self::not_published => '<span class=" badge badge-sm" style="color: white;font-size: 17px; background-color: #003e68">'.t('all','Not Published').'</span>',
            self::deleted => '<span class=" badge badge-sm" style="color: white;font-size: 17px; background-color: #607d8b">' .t('Deleted').'</span>',
        ];
    }

}
