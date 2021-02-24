<?php

namespace common\enums;

class RequestStatus extends PhpEnum {

    const new_request = 1;
    const under_process = 2;
    const done = 3;
    const rejected = -1;


    public static function Labels() {
        return [
            self::new_request => t('New Request'),
            self::under_process => t('Under Process'),
            self::done => t('Done'),
            self::rejected => t('Rejected'),
        ];
    }

    public static function SelectLabels() {
        return [
            self::under_process => t('Under Process'),
            self::done => t('Done'),
            self::rejected => t('Rejected'),
        ];
    }

    public static function LabelsStyle() {
        return [
            self::new_request => '<span class=" badge badge-sm" style="color: white;font-size: 17px; background-color: #b97d39">' .t('New Request').'</span>',
            self::under_process => '<span class=" badge badge-sm" style="color: white; font-size: 17px;background-color: #5d71ff">' .t('Under Process').'</span>',
            self::done => '<span class=" badge badge-sm" style="color: white; font-size: 17px;background-color: #53ff43">' .t('Done').'</span>',
            self::rejected => '<span class=" badge badge-sm" style="color: white; font-size: 17px;background-color: #ff3025">' .t('Rejected').'</span>',
        ];
    }

}
