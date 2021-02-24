<?php

namespace frontend\controllers;

use common\enums\ActiveInactiveStatus;
use common\enums\Constents;
use common\enums\PlaceType;
use common\enums\RequestEnums;
use common\enums\RequestStatus;
use common\enums\RequestTypes;
use common\models\PlaceContents;
use common\models\Product;
use common\models\Request;
use common\models\search\PlaceContentsSearch;
use Yii;
use common\models\Place;
use common\models\search\PlaceSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;

/**
 * PlaceController implements the CRUD actions for Place model.
 */
class PackagesController extends \common\utils\Controller
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
                        'actions' => ['index', 'package-details'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['check'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Place models.
     * @return mixed
     */

    public function actionIndex()
    {
        $searchModel = new PlaceSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $query = Place::find()->andWhere(['place.type' =>PlaceType::package])
            ->andWhere(['place.status' =>ActiveInactiveStatus::active]);
        $packagesDataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 6,

            ],
        ]);
        $model = new Request();
        $get = Yii::$app->request->get();
        if(isset($get[1])){
            $model->load($get[1]);
        }

        $post = Yii::$app->request->post();

//        if ($model->load($post)) {
////            stopv('xx');
//            $model->status = RequestStatus::new_request;
//            $model->created_date = date(Constents::full_date_format);
//            $model->type = RequestTypes::place;
//
//            $model->user_id = user()->id;
//            $model->fname = user()->fname;
//            $model->lname = user()->lname;
//            $model->phone = user()->phone;
//            $model->email = user()->email;
//            $model->enums = RequestEnums::package;
////            stopv($model);
//            $model->save();
//        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'packagesDataProvider' => $packagesDataProvider,
            'model' => $model,
        ]);
    }

    public function actionPackageDetails($id = 0)
    {
        $package = Place::find()
            ->andWhere(['status' => ActiveInactiveStatus::active])
            ->andWhere(['id' => $id])
            ->one();

        return $this->render('packageDetails', [
            'model' => $package,


        ]);
    }

    public function actionCheck($id = 0)
    {
        $model = Place::findone($id);

        return $this->render('check_out', [
            'model' => $model,

        ]);
    }

}

