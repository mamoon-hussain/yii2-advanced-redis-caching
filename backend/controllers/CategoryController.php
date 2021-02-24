<?php

namespace backend\controllers;

use common\enums\ActiveInactiveStatus;
use common\enums\Constents;
use common\models\LocalizedCategory;
use Yii;
use common\models\Category;
use common\models\generated\search\CategorySearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends \common\utils\Controller
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
                        'actions' => ['index', 'view', 'create', 'update', 'localization', 'delete', 'change-status'],
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
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
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
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();
        $post = Yii::$app->request->post();

        if ($model->load($post)) {
            $model->status = ActiveInactiveStatus::active;
            $model->created_date = date(Constents::full_date_format);
//            $model->imagesFile = UploadedFile::getInstance($model,'imagesFile');
//            if($model->imagesFile)
//            {
//                $model->uploadImage('image','imagesFile');
//            }

            if(!$model->save()){
stopv($model->errors);
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
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $post = Yii::$app->request->post();

        if ($model->load($post)) {
//            $model->imagesFile = UploadedFile::getInstance($model,'imagesFile');
//            if($model->imagesFile)
//            {
//                $model->uploadImage('image','imagesFile');
//            }

            if(!$model->save()){

                return $this->render('create', [
                    'model' => $model,
                ]);
            }

            Yii::$app->session->setFlash('flash_success', t("Saved"));
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Category model.
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

    public function actionChangeStatus($id, $s)
    {
        $model = $this->findModel($id);
        $post = Yii::$app->request->post();
        if ($post)
        {
            //stopv($model->status);
            $model->status = $post['status'];
            if(!$model->save()){
                stopv($model->errors);
            }

//            stopv($ads_id);
            Yii::$app->session->setFlash('flash_success', t('Saved'));
            return $this->redirect(['index?t='.$model->type.'']);
        }

        return $this->renderAjax('/shared/change_status', [
            'model' => $model,
            'title' => t('Change Status'),
            'content' => t('Are you sure?'),
            'status' => $s,
        ]);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionLocalization($id)
    {
        $itemModel = Category::findOne($id);
        $langModels = [];
        foreach (Yii::$app->params['languages'] as $one){
            $langModel = LocalizedCategory::find()
                ->andWhere(['lang' => $one])
                ->andWhere(['item_id' => $id])
                ->one();
            if(!$langModel){
                $langModel = new LocalizedCategory();
                $langModel->item_id = $id;
                $langModel->lang = $one;
            }
            $langModels[$one] = $langModel;
        }

        $post = Yii::$app->request->post();
        if ($post) {
            $ok = true;
            $dependancies = [];
            foreach ($langModels as $lang => $langModel){
                $langModel->load(['LocalizedCategory' => $post[$lang.'_LocalizedCategory']]);
                if(!$langModel->save()){
                    $ok = false;
                    \Yii::$app->getSession()->setFlash('flash_error', \Yii::t('all', 'Error in saving Localization'));
                }
            }

            if($ok){
                \Yii::$app->getSession()->setFlash('flash_success', \Yii::t('all', 'Localization added'));
            }
            return $this->redirect(['index']);
        }

        return $this->renderAjax('/localization/category', [
            'langModels' => $langModels,
            'itemModel' => $itemModel,
        ]);
    }
}
