<?php


namespace common\models;

use webvimark\modules\UserManagement\UserManagementModule;
use Yii;
use common\enums\Constents;
use webvimark\modules\UserManagement\models\ZAdmin;

class Admin extends ZAdmin {

    public function rules() {
        $p = parent::rules();
        $p[] = [['auth_expiry', 'auth_key'], 'safe'];
        return $p;
    }

    public function attributeLabels()
    {
        $p = parent::attributeLabels();
        $p['username'] = t('User Name');
        $p['fname'] = t('First Name');
        $p['repeat_password'] = t('Repeat Password');
        $p['role'] = t('Role');
        return $p;
    }

    public function getImageUrl() {
        if ($this->photo) {
            return imageURL("images_user/" . $this->photo);
        } else {
            return imageURL('images_user/user.png');
        }
    }

    public function getAuthKey()
    {
        if(!$this->auth_expiry || $this->auth_expiry < date(Constents::full_date_format)){
            throw new \yii\web\HttpException(504, "Auth Token Expired!", 504);
        }
        return $this->auth_key;
    }

    public function getSetAuthKey()
    {
        if(!$this->auth_expiry || $this->auth_expiry < date(Constents::full_date_format)){
            $this->auth_expiry = date(Constents::full_date_format, strtotime(date(Constents::full_date_format) . ' +1 month'));
            $this->auth_key = Yii::$app->security->generateRandomString()
                . Yii::$app->security->generateRandomString()
                . Yii::$app->security->generateRandomString()
                . '_' . time();
            if(!$this->save()){
                stopv($this->errors);
            }
        }
        return $this->auth_key;
    }

    public static function getStatusList() {
        return array(
            self::STATUS_ACTIVE => t( 'Active'),
            self::STATUS_INACTIVE => t( 'Inactive'),
            self::STATUS_BANNED => t( 'Banned'),
        );
    }

    public static function getStatusValue($val) {
        $ar = self::getStatusList();

        return isset($ar[$val]) ? $ar[$val] : $val;
    }

}