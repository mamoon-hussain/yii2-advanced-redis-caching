<?php


namespace common\models;

use common\enums\ActiveInactiveStatus;
use webvimark\modules\UserManagement\models\ZUser;
use Yii;
use common\enums\Constents;
use webvimark\modules\UserManagement\models\ZAdmin;
use yii\imagine\Image;

class Notification extends generated\Notification {


//    public function rules()
//    {
//        $p = parent::rules();
//        return $p;
//    }

    public function attributeLabels()
    {
        $p = parent::attributeLabels();
        $p['id'] = t( "ID");
        $p['title'] = t( "Title");
        $p['create_date'] = t( "Create Date/Time");
        $p['body'] = t("Body");
        $p['status'] = t("Status");
        return $p;
    }



}