<?php

namespace backend\controllers;

use common\enums\ContactUsStatus;
use common\enums\RequestStatus;
use Yii;
use common\models\ContactUs;
use common\models\generated\search\ContactUsSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContactUsController implements the CRUD actions for ContactUs model.
 */
class ContactUsController extends \common\utils\Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'delete', 'change-status'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new ContactUsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = ContactUs::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionChangeStatus($id)
    {
        $model = $this->findModel($id);


        $model->status = ContactUsStatus::closed;

        $post = Yii::$app->request->post();
        if ($model->load($post))
        {
            //stopv($model->status);
            if(!$model->save()){
                stopv($model->errors);
            }
            Yii::$app->session->setFlash('success', "Saved");
            Yii::$app->getResponse()->redirect(Yii::$app->request->referrer);
            return;
//            return $this->redirect(['index']);
        }

        return $this->renderAjax('/shared/change_status_choose', [
            'model' => $model,
            'title' => t('Change Status'),
            'status_list' => ContactUsStatus::Labels(),
        ]);
    }
}
