<?php

namespace common\utils;

use webvimark\modules\UserManagement\models\rbacDB\AuthItemGroup;
use webvimark\modules\UserManagement\models\rbacDB\Permission;
use Yii;

class Controller extends \yii\web\Controller {

    public function beforeAction($action) {
        $permissionName = Yii::$app->controller->id . '_' . Yii::$app->controller->action->id;
        $permissionDesc = ucfirst(Yii::$app->controller->id) . ' ' . ucfirst(Yii::$app->controller->action->id);
        AuthItemGroup::create(Yii::$app->controller->id, ucfirst(Yii::$app->controller->id));
        Permission::create($permissionName, $permissionDesc, Yii::$app->controller->id);

        if (Yii::$app->session->has('lang')) {
            Yii::$app->language = Yii::$app->session->get('lang');
        } else {
            Yii::$app->language = 'en';
        }
//        Yii::$app->language = 'de';
        return parent::beforeAction($action);
    }

}
