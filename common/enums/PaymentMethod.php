<?php

namespace common\enums;

class PaymentMethod extends PhpEnum {

    const paypal = 1;
    const cash = 2;

    public static function Labels() {
        return [
            self::paypal => t('PayPal'),
            self::cash => t('Cash'),
        ];
    }

    public static function LabelsStyle() {
        return [
            self::paypal => '<span class=" badge badge-sm" style="color: white; font-size: 17px;background-color: #1866ff">' .t('PayPal').'</span>',
            self::cash => '<span class=" badge badge-sm" style="color: white; font-size: 17px;background-color: #ffaa0e">' .t('Cash').'</span>',
        ];
    }

}
