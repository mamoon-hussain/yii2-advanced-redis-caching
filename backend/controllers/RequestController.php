<?php

namespace backend\controllers;

use common\enums\RequestEnums;
use common\enums\RequestStatus;
use common\models\Notification;
use Yii;
use common\models\Request;
use common\models\search\RequestSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RequestController implements the CRUD actions for Request model.
 */
class RequestController extends \common\utils\Controller
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
                        'actions' => ['index', 'view', 'view-modal', 'change-request-status', 'delete', 'change-status'],
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

    /**
     * Lists all Request models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Request model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $enums = $model->enums;
        $type = $model->type;

        $notification = Notification::find()
            ->andWhere(['data_id' => $id])
            ->andWhere(['user_id' => userId()])
            ->andWhere(['is_read' => 0])
            ->one();
        if($notification){
            $notification->is_read = 1;
            $notification->save();
        }

        return $this->render('view', [
            'model' => $model,
            'enums' => $enums,
            'type' => $type,
        ]);
    }

    public function actionViewModal($id)
    {
        $model = $this->findModel($id);
        $enums = $model->enums;
        $type = $model->type;

        return $this->renderAjax('view', [
            'model' => $model,
            'enums' => $enums,
            'type' => $type,
        ]);
    }

    /**
     * Deletes an existing Request model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Request model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Request the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Request::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionChangeRequestStatus($id)
    {
        $model = $this->findModel($id);


        switch ($model->status){
            case RequestStatus::new_request:
                $model->status = RequestStatus::under_process;
                break;
            case RequestStatus::under_process:
                $model->status = RequestStatus::done;
                break;
            default:
                $model->status = RequestStatus::new_request;
                break;
        }

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

        return $this->renderAjax('change_request_status', [
            'model' => $model,
            'title' => t('Change Status'),
        ]);
    }
}
