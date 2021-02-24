<?php

namespace backend\controllers;

use common\enums\ActiveInactiveStatus;
use common\enums\Constents;
use common\enums\PaintingToolType;
use common\models\LocalizedProduct;
use common\models\ProductFrames;
use common\models\search\ProductFramesSearch;
use Yii;
use common\models\Product;
use common\models\search\ProductSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use common\enums\PlaceType;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends \common\utils\Controller
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
                        'actions' => ['index', 'view', 'create', 'update', 'localization', 'delete', 'change-status', 'add-new-image', 'delete-image'],
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex($t=0)
    {
        $searchModel = new ProductSearch();

        $query = Product::find()
            ->andWhere(['product.type' => $t])
        ;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$query);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'type'=> $t,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $imagesSm = new ProductFramesSearch();
        $imagesSm->product_id = $id;
        $imagesDp = $imagesSm->search(Yii::$app->request->queryParams);


        return $this->render('view', [
            'model' => $model,
            'type' => $model->type,
            'imagesSm' => $imagesSm,
            'imagesDp' => $imagesDp,
        ]);
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($t = 0)
    {
        $model = new Product();
        $post = Yii::$app->request->post();

        if ($model->load($post)) {
            $model->status = ActiveInactiveStatus::active;
            $model->create_date = date(Constents::full_date_format);
            $model->type = $t;

//            $model->imagesFile = UploadedFile::getInstance($model,'imagesFile');
//            if($model->imagesFile)
//            {
//                $model->uploadImage('image','imagesFile');
//            }

            $model->videoFile = UploadedFile::getInstance($model,'videoFile');
            if($model->videoFile)
            {
                $model->uploadVideo();
            }

            if(!$model->save()){
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
            $model->saveProductImages();
            Yii::$app->session->setFlash('flash_success', t("Saved"));
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'type' => $t,
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $post = Yii::$app->request->post();
        $type = $model->type;

        if ($model->load($post)) {
//            $model->imagesFile = UploadedFile::getInstance($model,'imagesFile');
//            if($model->imagesFile)
//            {
//                $model->uploadImage('image','imagesFile');
//            }

            $model->videoFile = UploadedFile::getInstance($model,'videoFile');
            if($model->videoFile)
            {
                $model->uploadVideo();
            }

            if(!$model->save()){
                return $this->render('create', [
                    'model' => $model,
                ]);
            }

            $model->saveProductImages(isset($post['preview']) ? $post['preview'] : []);
            Yii::$app->session->setFlash('flash_success', t("Saved"));
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'type' => $type,
        ]);
    }

    public function actionAddNewImage($id = 0)
    {
        $model = new ProductFrames();
        return $this->renderAjax('new-images',[
            'model' => $model,
            'id' =>$id,
        ]);
    }


    public function actionDeleteImage($id)
    {
//        stopv($id);
        $model = ProductFrames::findOne($id);
        $post = Yii::$app->request->post();
        if ($post)
        {
            $p_id = $model->product_id;
            $model->delete();
            return $this->redirect(['view', 'id' => $p_id]);
        }

        return $this->renderAjax('/shared/change_status', [
            'model' => $model,
            'title' => t('Delete Image'),
            'content' => t('Are you sure?'),
            'status' => 0,

        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model =  $this->findModel($id);
        $model->delete();
        Yii::$app->session->setFlash('flash_success', t("Saved"));
        return $this->redirect(['index?t='.$model->type.'']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionLocalization($id)
    {
        $itemModel = Product::findOne($id);
        $langModels = [];
        foreach (Yii::$app->params['languages'] as $one){
            $langModel = LocalizedProduct::find()
                ->andWhere(['lang' => $one])
                ->andWhere(['item_id' => $id])
                ->one();
            if(!$langModel){
                $langModel = new LocalizedProduct();
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
                $langModel->load(['LocalizedProduct' => $post[$lang.'_LocalizedProduct']]);
                if(!$langModel->save()){
                    $ok = false;
                    \Yii::$app->getSession()->setFlash('flash_error', \Yii::t('all', 'Error in saving Localization'));
                }
                if(isset($post[$lang.'_descriptions'])){
                    foreach ($post[$lang.'_descriptions'] as $one){
                        $one['lang'] = $lang;
                        $dependancies[] = $one;
                    }
                }
            }

            if($ok){
                \Yii::$app->getSession()->setFlash('flash_success', \Yii::t('all', 'Localization added'));
            }
            return $this->redirect(['index', 't' => $itemModel->type]);
        }

        return $this->renderAjax('/localization/product', [
            'langModels' => $langModels,
            'itemModel' => $itemModel,
        ]);
    }
}
