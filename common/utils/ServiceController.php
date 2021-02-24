<?php

namespace common\utils;

use common\enums\ErrorCode;
use webvimark\modules\UserManagement\models\rbacDB\AuthItemGroup;
use webvimark\modules\UserManagement\models\rbacDB\Permission;
use Yii;

class ServiceController extends \webvimark\modules\UserManagement\controllers\ServiceController {

    public function isRegisteredUser() {
        if(!authkey()){
            throw new \yii\web\HttpException(401, implode('/*/', ["Not Authorized", ErrorCode::token_not_found]), 401);
        }
        if (!($u = user())) {
            throw new \yii\web\HttpException(403, implode('/*/', ["You are not allowed to perform this action.", ErrorCode::login_required]), 403);
        }

        Yii::$app->user->login($u, 0);
        return $u->id;
    }

    public function isConfirmedUser() {
        if(!authkey()){
            throw new \yii\web\HttpException(401, implode('/*/', ["Not Authorized", ErrorCode::token_not_found]), 401);
        }
        if (!($u = user())) {
            throw new \yii\web\HttpException(403, implode('/*/', ["You are not allowed to perform this action.", ErrorCode::login_required]), 403);
        }
//        if(!$u->mobile_confirmed){
//            throw new \yii\web\HttpException(200, implode('/*/', ['Phone not confirmed!', ErrorCode::account_not_verified]), 200);
//        }
        if(!$u->email_confirmed){
            throw new \yii\web\HttpException(200, implode('/*/', ['Email not confirmed!', ErrorCode::account_not_verified]), 200);
        }

        Yii::$app->user->login($u, 0);
        return $u->id;
    }

}
