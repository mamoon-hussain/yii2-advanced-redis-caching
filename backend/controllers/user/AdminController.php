<?php

namespace backend\user\controllers;

use webvimark\modules\UserManagement\models\AuthAssignment;
use yii\data\ActiveDataProvider;
use common\models\Admin;
use yii\web\NotFoundHttpException;

class AdminController extends \webvimark\modules\UserManagement\controllers\AdminController {

    public function actionIndex() {
        $searchModel = new \common\models\search\AdminSearch();

        if ($searchModel) {
            $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
        } else {
            $modelClass = $this->modelClass;
            $dataProvider = new ActiveDataProvider([
                'query' => $modelClass::find(),
            ]);
        }
        return $this->renderIsAjax('index', compact('dataProvider', 'searchModel'));
    }




}
