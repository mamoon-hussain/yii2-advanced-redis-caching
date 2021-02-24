<?php

namespace backend\controllers;

use common\enums\ActiveInactiveStatus;
use common\enums\Constents;
use common\models\Admin;
use common\models\AppInfo;
use common\models\LocalizedAppInfo;
use common\models\LocalizedPath;
use Yii;
use common\models\Area;
use common\models\search\AreaSearch;
use yii\filters\AccessControl;
use common\utils\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * AppInfoController implements the CRUD actions for Area model.
 */
class AppInfoController extends Controller
{
    public $defaultAction = 'view';
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
                        'actions' => ['view', 'update', 'localization'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function () {
                            $permissionName = Yii::$app->controller->id . '_' . Yii::$app->controller->action->id;
                            return Admin::hasPermission($permissionName);
                        }
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

    public function actionView()
    {
        $model = AppInfo::find()->one();
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionUpdate()
    {
        $model = AppInfo::find()->one();

        if ($model->load(Yii::$app->request->post())) {
            $model->videoFile = UploadedFile::getInstance($model,'videoFile');
            if($model->videoFile)
            {
                $model->uploadVideo();
            }
            if(!$model->save()){
                return $this->render('update', [
                    'model' => $model,
                ]);
            }

            \Yii::$app->getSession()->setFlash('flash_success', \Yii::t('all', 'Saved'));
            return $this->redirect(['view']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionLocalization()
    {
        $itemModel = AppInfo::find()->one();
        $langModels = [];
        foreach (Yii::$app->params['languages'] as $one){
            $langModel = LocalizedAppInfo::find()
                ->andWhere(['lang' => $one])
                ->andWhere(['item_id' => $itemModel->id])
                ->one();
            if(!$langModel){
                $langModel = new LocalizedAppInfo();
                $langModel->item_id = $itemModel->id;
                $langModel->lang = $one;
            }
            $langModels[$one] = $langModel;
        }

        $post = Yii::$app->request->post();
        if ($post) {
            $ok = true;
            foreach ($langModels as $lang => $langModel){
                $langModel->load(['LocalizedAppInfo' => $post[$lang.'_LocalizedAppInfo']]);
                if(!$langModel->save()){
                    $ok = false;
                    \Yii::$app->getSession()->setFlash('flash_error', \Yii::t('all', 'Error in saving Localization'));
                }
            }

            if($ok){
                \Yii::$app->getSession()->setFlash('flash_success', \Yii::t('all', 'Localization added'));
            }
            return $this->redirect(['/app-info']);
        }

        return $this->renderAjax('/localization/app_info', [
            'langModels' => $langModels,
            'itemModel' => $itemModel,
        ]);
    }

}
