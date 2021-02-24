<?php

namespace backend\controllers;

use common\enums\ActiveInactiveStatus;
use common\enums\Constents;
use Yii;
use common\models\ProductFrames;
use common\models\search\ProductFramesSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductFramesController implements the CRUD actions for ProductFrames model.
 */
class ProductFramesController extends \common\utils\Controller
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
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'change-status'],
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
     * Lists all ProductFrames models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductFramesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductFrames model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProductFrames model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductFrames();

        $post = Yii::$app->request->post();

        if ($model->load($post)) {
            $model->imagesFile = UploadedFile::getInstance($model,'imagesFile');
            if($model->imagesFile)
            {
                $model->uploadImage('image','imagesFile');
            }

            if(!$model->save())
            {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
            Yii::$app->session->setFlash('flash_success', t("Saved"));
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ProductFrames model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        Yii::$app->session->setFlash('flash_success', t("Saved"));
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ProductFrames model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('flash_success', t("Saved"));
        return $this->redirect(['index']);
    }

    /**
     * Finds the ProductFrames model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductFrames the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductFrames::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
