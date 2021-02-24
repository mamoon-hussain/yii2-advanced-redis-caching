<?php

namespace common\models;

use common\enums\Constents;
use common\models\Product;
use Yii;


class ContactUs extends \common\models\generated\ContactUs
{
    public function attributeLabels()
    {
        $p = parent::attributeLabels();
        $p['id'] = t("ID");
        $p['name'] = t("Name");
        $p['phone'] = t("Phone");
        $p['status'] = t("Status");
        $p['create_date'] = t("Create Date");
//
        return $p;
    }


}
