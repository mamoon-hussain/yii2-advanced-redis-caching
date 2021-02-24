<?php

namespace backend\controllers;

use common\enums\ActiveInactiveStatus;
use common\enums\Constents;
use common\models\generated\search\PlaceImageSearch;
use common\models\LocalizedPlace;
use common\models\LocalizedPlaceContents;
use common\models\PlaceContents;
use common\models\PlaceImage;
use common\models\ProductFrames;
use common\models\search\PlaceContentsSearch;
use common\models\search\ProductFramesSearch;
use common\models\search\RequestSearch;
use Yii;
use common\models\Place;
use common\models\search\PlaceSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PlaceController implements the CRUD actions for Place model.
 */
class PlaceController extends \common\utils\Controller
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
                        'actions' => ['index', 'view', 'localization', 'create', 'update', 'delete', 'change-status',
                            'delete-content', 'add-new-content', 'add-new-image', 'delete-image'],
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
     * Lists all Place models.
     * @return mixed
     */
    public function actionIndex($t=0)
    {
        $searchModel = new PlaceSearch();

        $query = Place::find()
            ->andWhere(['place.type' => $t])
        ;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$query);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'type' => $t,
        ]);
    }

    /**
     * Displays a single Place model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $contentSm = new PlaceContentsSearch();
        $contentSm->place_id = $id;
        $contentDp = $contentSm->search(Yii::$app->request->queryParams);

        $imagesSm = new PlaceImageSearch();
        $imagesSm->place_id = $id;
        $imagesDp = $imagesSm->search(Yii::$app->request->queryParams);

        $requestSearchModel = new RequestSearch();
        $requestSearchModel->place_id = $id;
        $requestDataProvider = $requestSearchModel->search(Yii::$app->request->queryParams);

        return $this->render('view', [
            'model' => $model,
            'contentDp' => $contentDp,
            'contentSm' => $contentSm,
            'requestSearchModel' => $requestSearchModel,
            'requestDataProvider' => $requestDataProvider,
            'imagesSm' => $imagesSm,
            'imagesDp' => $imagesDp,
        ]);
    }

    /**
     * Creates a new Place model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($t = 0)
    {
        $model = new Place();
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

            if(!$model->save())
            {
                stopv($model->errors);
                return $this->render('create', [
                    'model' => $model,
                    'type' => $t,
                ]);
            }
            $model->saveContents(isset($post['content']) ? $post['content'] : []);
            $model->savePlaceImages();
            Yii::$app->session->setFlash('flash_success', t("Saved"));
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'type' => $t,
        ]);
    }

    /**
     * Updates an existing Place model.
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

            if(!$model->save())
            {
                stopv($model->errors);
            }
//            Yii::$app->session->setFlash('flash_success', t("Saved"));
            $model->saveContents(isset($post['content']) ? $post['content'] : []);
            $model->savePlaceImages();
            Yii::$app->session->setFlash('flash_success', t("Saved"));
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'type' => $type,
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
            return $this->redirect(['index?t='.$model->type.'']);
        }

        return $this->renderAjax('/shared/change_status', [
            'model' => $model,
            'title' => t('Change Status'),
            'content' => t('Are you sure?'),
            'status' => $s,
        ]);
    }

    public function actionDeleteContent($id)
    {
        $model = PlaceContents::findOne($id);
        $post = Yii::$app->request->post();
        if ($post)
        {
            $p_id = $model->place_id;
            $model->delete();

            return $this->redirect(['view', 'id' => $p_id]);
        }

        return $this->renderAjax('/shared/change_status', [
            'model' => $model,
            'title' => t('Delete Content'),
            'content' => t('Are you sure?'),
            'status' => 0,

        ]);
    }






    /**
     * Deletes an existing Place model.
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
     * Finds the Place model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Place the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Place::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAddNewContent($id = 0)
    {
        $model = new PlaceContents();
//        stopv($model);
        return $this->renderAjax('new-contents',[
            'model' => $model,
            'id' => $id,
        ]);
    }

    public function actionAddNewImage($id = 0)
    {
        $model = new PlaceImage();
        return $this->renderAjax('new-images',[
            'model' => $model,
            'id' =>$id,
        ]);
    }

    public function actionDeleteImage($id)
    {
//        stopv($id);
        $model = PlaceImage::findOne($id);
        $post = Yii::$app->request->post();
        if ($post)
        {
            $p_id = $model->place_id;
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

    public function actionLocalization($id)
    {
        $itemModel = Place::findOne($id);
        $langModels = [];
        foreach (Yii::$app->params['languages'] as $one){
            $langModel = LocalizedPlace::find()
                ->andWhere(['lang' => $one])
                ->andWhere(['item_id' => $id])
                ->one();
            if(!$langModel){
                $langModel = new LocalizedPlace();
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
                $langModel->load(['LocalizedPlace' => $post[$lang.'_LocalizedPlace']]);
                if(!$langModel->save()){
                    $ok = false;
                    \Yii::$app->getSession()->setFlash('flash_error', \Yii::t('all', 'Error in saving Localization'));
                }
                if(isset($post[$lang.'_contents'])){
                    foreach ($post[$lang.'_contents'] as $one){
                        $one['lang'] = $lang;
                        $dependancies[] = $one;
                    }
                }
            }

            //save dependancies
            foreach ($dependancies as $one){
                $localized_dep = LocalizedPlaceContents::find()
                    ->andWhere(['item_id' => $one['id']])
                    ->andWhere(['lang' => $one['lang']])
                    ->one();
                if(!$localized_dep){
                    $localized_dep = new LocalizedPlaceContents();
                    $localized_dep->item_id = $one['id'];
                    $localized_dep->lang = $one['lang'];
                }
                $localized_dep->content = $one['content'];
                if(!$localized_dep->save()){
                    $ok = false;
                    \Yii::$app->getSession()->setFlash('flash_error', \Yii::t('all', 'Error in saving Localization'));
                }
            }
            //
            if($ok){
                \Yii::$app->getSession()->setFlash('flash_success', \Yii::t('all', 'Localization added'));
            }
            return $this->redirect(['index', 't' => $itemModel->type]);
        }

        return $this->renderAjax('/localization/place', [
            'langModels' => $langModels,
            'itemModel' => $itemModel,
        ]);
    }

}

