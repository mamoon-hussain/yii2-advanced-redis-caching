<?php


namespace common\widgets;


use dosamigos\datepicker\DatePicker;

class BaseDatePicker extends DatePicker
{
    public $inline = true;
    public $clientOptions = [
        'autoclose' => true,
        'format' => 'yyyy-mm-dd',
        'clearBtn' => true,
    ];
}