<?php

namespace common\enums;

class WeekDays extends PhpEnum {

    const sunday = 'Sunday';
    const monday = 'Monday';
    const tuesday = 'Tuesday';
    const wednesday = 'Wednesday';
    const thursday = 'Thursday';
    const friday = 'Friday';
    const saturday = 'Saturday';


    public static function Labels() {
        return [
            self::sunday => t('Sunday'),
            self::monday => t('Monday'),
            self::tuesday => t('Tuesday'),
            self::wednesday => t('Wednesday'),
            self::thursday => t('Thursday'),
            self::friday => t('Friday'),
            self::saturday => t('Saturday'),
        ];
    }

    public static function DayOfWeek($day) {
        switch ($day){
            case self::sunday:
                return 1;
                break;

            case self::monday:
                return 2;
                break;

            case self::tuesday:
                return 3;
                break;

            case self::wednesday:
                return 4;
                break;

            case self::thursday:
                return 5;
                break;

            case self::friday:
                return 6;
                break;

            case self::saturday:
                return 7;
                break;
        }
    }


}
