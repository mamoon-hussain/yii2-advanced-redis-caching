<?php

namespace backend\controllers;

use common\enums\Constents;
use common\enums\SentNotsentStatus;
use common\services\FirebaseService;
use Yii;
use common\models\Notification;
use common\models\search\NotificationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NotificationController implements the CRUD actions for Notification model.
 */
class NotificationController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Notification models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NotificationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Notification model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
//    public function actionView($id)
//    {
//        return $this->render('view', [
//            'model' => $this->findModel($id),
//        ]);
//    }

    /**
     * Creates a new Notification model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Notification();

        $post = Yii::$app->request->post();
        if ($model->load($post)) {
            $model->status = SentNotsentStatus::notSent;
            $model->topec_name = SentNotsentStatus::notification_topic_name;
            $model->create_date = date(Constents::full_date_format);
            if(!$model->save())
            {
                stopv($model->errors);
            }
            Yii::$app->session->setFlash('flash_success', t("Saved"));
//            $message = FirebaseService::send(SentNotsentStatus::Topic,$model->title, $model->body, $data = []);

            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Notification model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if($model->status != SentNotsentStatus::sent){
                if(!$model->save()){
                    Yii::$app->session->setFlash('flash_error', t("Error saving"));
                } else {
                    Yii::$app->session->setFlash('flash_success', t("Saved"));
                }
            } else {
                Yii::$app->session->setFlash('flash_error', t("Can't edit a sent notification!"));
            }
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Notification model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if($model->status != SentNotsentStatus::sent){
            $model->delete();
            Yii::$app->session->setFlash('flash_success', t("Deleted"));
        } else {
            Yii::$app->session->setFlash('flash_error', t("Can't delete a sent notification!"));
        }

        return $this->redirect(['index']);
    }

    public function actionSend($id)
    {
        $model = $this->findModel($id);
        $post = Yii::$app->request->post();
        if ($post)
        {
            $model->status = SentNotsentStatus::sent;
            $model->sent_date = date('Y-m-d H:i:s');
            if(!$model->save()){
                stopv($model->errors);
            }
            list($res, $msg) = FirebaseService::sendToTopic(SentNotsentStatus::notification_topic_name,$model->title, $model->body);
            if($res){
                Yii::$app->session->setFlash('flash_success', t('Notification Sent'));
            } else {
                Yii::$app->session->setFlash('flash_error', $msg);
            }

            return $this->redirect(['index']);
        }

        return $this->renderAjax('/shared/change_status', [
            'model' => $model,
            'title' => t('Send Notification'),
            'content' => t('Are you sure?'),
            'status' => SentNotsentStatus::sent,
        ]);
    }


    /**
     * Finds the Notification model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Notification the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Notification::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
