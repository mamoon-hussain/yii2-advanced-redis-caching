<?php

namespace common\models;

use common\enums\Constents;
use common\models\Request;
use Yii;


class RequestDates extends generated\RequestDates
{
    public function getRequest()
    {
        return $this->hasOne(Request::className(), ['id' => 'request_id']);
    }


}
