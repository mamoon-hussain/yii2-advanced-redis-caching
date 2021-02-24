<?php


namespace common\models;

use common\enums\OrderAddressType;
use webvimark\modules\UserManagement\models\ZUser;
use Yii;
use common\enums\Constents;
use webvimark\modules\UserManagement\models\ZAdmin;

class User extends ZUser {

    public function rules() {
        $p = parent::rules();
        $p[] = [['birth_date'], 'safe'];
        return $p;
    }

    public function scenarios() {
        $p = parent::scenarios();
        $p[self::scenario_createByUser] = ['lat', 'lng', 'fname', 'lname', 'address', 'username', 'password', 'email', 'phone', 'country', 'photo', 'birth_date'];
        $p[self::scenario_updateByUser] = ['username', 'lat', 'lng', 'fname', 'lname', 'address', 'phone', 'country', 'photo', 'birth_date'];
        return $p;
    }

    public function getBillingAddress()
    {
        $model = UserAddress::find()
            ->andWhere(['type' => OrderAddressType::billing])
            ->andWhere(['user_id' => $this->id])
            ->one();
        return $model;
    }

    public function getDeliveryAddress()
    {
        $model = UserAddress::find()
            ->andWhere(['type' => OrderAddressType::delivery])
            ->andWhere(['user_id' => $this->id])
            ->one();
        return $model;
    }

    public function getSetAuthKey()
    {
        if(!$this->auth_expiry || $this->auth_expiry < date(Constents::full_date_format)){
            $this->auth_expiry = date(Constents::full_date_format, strtotime(date(Constents::full_date_format) . ' +1 month'));
            $this->auth_key = Yii::$app->security->generateRandomString()
                . Yii::$app->security->generateRandomString()
                . Yii::$app->security->generateRandomString()
                . '_' . time();
            $this->save();
        }
        return $this->auth_key;
    }

    public function getSetNewAuthKey()
    {
        $this->auth_expiry = date(Constents::full_date_format, strtotime(date(Constents::full_date_format) . ' +1 month'));
        $this->auth_key = Yii::$app->security->generateRandomString()
            . Yii::$app->security->generateRandomString()
            . Yii::$app->security->generateRandomString()
            . '_' . time();
        $this->save();
        return $this->auth_key;
    }

}