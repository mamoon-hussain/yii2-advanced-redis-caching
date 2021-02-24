<?php

namespace backend\controllers\user;

use webvimark\components\AdminDefaultController;
use Yii;
use webvimark\modules\UserManagement\controllers\UserController as BaseUserController;

/**
 * UserController implements the CRUD actions for User model.
 * No. 300
 */
class UserController extends BaseUserController {

    public $modelSearchClass = 'common\models\search\UserSearch';

    public function actionDelete($id) {
        $model = $this->findModel($id);
        $model->status = ActiveInactiveStatus::deleted;
        if(!$model->save()){
             stopv($model->errors,t('Error no. 303'));
        }
        \Yii::$app->getSession()->setFlash('flash_success', \Yii::t('all', 'Deleted'));

        return $redirect === false ? '' : $this->redirect($redirect);
    }
}
