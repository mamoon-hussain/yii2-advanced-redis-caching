<?php

namespace frontend\controllers\user;

use common\enums\OrderAddressType;
use common\models\search\UserOrderSearch;
use common\models\UserAddress;
use common\models\UserOrder;
use common\services\UserService;
use frontend\modules\UserManagementModule;
use webvimark\modules\UserManagement\libs\LibUser;
use webvimark\modules\UserManagement\models\ZAdmin;
use yii\web\NotFoundHttpException;
use Yii;
use common\services\OrderService;

class ProfileController extends \webvimark\modules\UserManagement\controllers\ProfileController {

    public function actionView($p=0) {
        $this->layout = '//main';
        $model = LibUser::Profile();
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionDeliveryAddress() {
        $model = UserAddress::find()
            ->andWhere(['user_id' => userId()])
            ->andWhere(['type' => OrderAddressType::delivery])
            ->one();
        if(!$model){
            $model = new UserAddress();
        }
        $post = Yii::$app->request->post();
        if($model->load($post)){
            $model->user_id = userId();
            $model->type = OrderAddressType::delivery;
            if(!$model->save()){
                stopv($model->errors);
            }
            \Yii::$app->getSession()->setFlash('flash_success', t('Saved'));
        }
        return $this->render('user_address', [
            'title' => t('Delivery Address'),
            'model' => $model,
        ]);
    }

    public function actionBillingAddress() {
        $model = UserAddress::find()
            ->andWhere(['user_id' => userId()])
            ->andWhere(['type' => OrderAddressType::billing])
            ->one();
        if(!$model){
            $model = new UserAddress();
        }
        $post = Yii::$app->request->post();
        if($model->load($post)){
            $model->user_id = userId();
            $model->type = OrderAddressType::billing;
            if(!$model->save()){
                stopv($model->errors);
            }
            \Yii::$app->getSession()->setFlash('flash_success', t('Saved'));
        }
        return $this->render('user_address', [
            'title' => t('Billing Address'),
            'model' => $model,
        ]);
    }

    public function actionUpdate() {
        list($result, $model) = UserService::profileUpdate(\Yii::$app->request->post());
        if ($result) {
            \Yii::$app->getSession()->setFlash('flash_success', t('Saved'));
            return $this->redirect(['update']);
        }
        return $this->render('update', ['model' => $model]);
    }

    public function actionOrders() {
        $searchModel = new UserOrderSearch();
        $query = UserOrder::find()
            ->andWhere(['user_id' => userId()]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $query);
        return $this->render('orders', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);


    }

    public function actionOrderDetails($id) {
                $id = OrderService::decryption($id);

        $model = UserOrder::findOne($id);
        if(!$model || ($model->user_id != userId())){
            stopv('Order not found');
        }
        return $this->renderAjax('order_details', [
            'model' => $model,
            'title' => t('Order Details'),
        ]);

    }

}
