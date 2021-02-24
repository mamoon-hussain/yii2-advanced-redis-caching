<?php

namespace backend\config;

use webvimark\modules\UserManagement\components\AuthHelper;
use yii\web\User;
use Yii;
/**
 * Class UserConfig
 * @package webvimark\modules\UserManagement\components
 */
class AdminConfig extends User {

    /**
     * @inheritdoc
     */
    public $identityClass = 'common\models\Admin';

    /**
     * @inheritdoc
     */
    public $enableAutoLogin = true;
    public $identityCookie = [
        'name' => '_backendUser', // unique for frontend
    ];

    /**
     * @inheritdoc
     */
    public $cookieLifetime = 2592000;

    /**
     * @inheritdoc
     */
    public $loginUrl = ['/user/auth/login'];

    /**
     * Allows to call Yii::$app->user->isSuperadmin
     *
     * @return bool
     */
    public function getIsSuperadmin() {
        return @Yii::$app->user->identity->superadmin == 1;
    }

    /**
     * @return string
     */
    public function getUsername() {
        return @Yii::$app->user->identity->username;
    }

    /**
     * @inheritdoc
     */
    protected function afterLogin($identity, $cookieBased, $duration) {
        AuthHelper::updatePermissions($identity);

        parent::afterLogin($identity, $cookieBased, $duration);
    }

}
