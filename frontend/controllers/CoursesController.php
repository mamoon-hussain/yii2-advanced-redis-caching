<?php

namespace frontend\controllers;

use common\enums\ActiveInactiveStatus;
use common\enums\Constents;
use common\enums\CourseType;
use common\enums\PaintingToolType;
use common\enums\PlaceType;
use common\enums\RequestEnums;
use common\enums\RequestStatus;
use common\models\PlaceContents;
use common\models\Product;
use common\models\Request;
use common\models\search\PlaceContentsSearch;
use common\models\User;
use Yii;
use common\models\Place;
use common\models\search\PlaceSearch;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PlaceController implements the CRUD actions for Place model.
 */
class CoursesController extends \common\utils\Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'offline-training', 'online-training', 'details'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['check-out'],
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
//        $this->layout = 'painting-layout';
        $searchModel = new PlaceSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $query = Place::find()->andWhere(['place.type' =>PlaceType::course]);
        $coursesDataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,

            ],
        ]);
        $courses = Place::find()->andWhere(['place.type' =>PlaceType::course ,'place.status' =>ActiveInactiveStatus::active])->all();

        $trainingCategories = Place::find()
            ->andWhere(['type' => PlaceType::course])->all();
        //$paintingDataProvider = $searchModel->search(Yii::$app->request->queryParams,$query);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'coursesDataProvider' => $coursesDataProvider,
            'trainingCategories' => $trainingCategories,
            'courses' => $courses,
        ]);
    }


    public function actionOfflineTraining()
    {
        $offlineTrainings = Place::find()
            ->andWhere(['status' => ActiveInactiveStatus::active])
            ->andWhere(['type' => PlaceType::course])
            ->andWhere(['course_type' => CourseType::direct])
            ->all();
        return $this->render('offlinetraining', [
            'offlineTrainings' => $offlineTrainings,
        ]);
    }

    public function actionOnlineTraining()
    {
        $onlineTrainings = Place::find()
            ->andWhere(['status' => ActiveInactiveStatus::active])
            ->andWhere(['type' => PlaceType::course])
            ->andWhere(['course_type' => CourseType::online])
            ->all();
        $requestNumber = Request::find()
            ->andWhere(['request.enums' => RequestEnums::course])
            ->leftJoin('place',['place.course_type'=>CourseType::online])->count();
        return $this->render('onlinetraining', [
            'onlineTrainings' => $onlineTrainings,
            'requestNumber' => $requestNumber,

        ]);
    }

    public function actionDetails($id)
    {
        $model = Place::findOne($id);
        if(!$model || $model->status != ActiveInactiveStatus::active){
            throw new NotFoundHttpException(t('The requested page does not exist.'));
        }

        return $this->render('details', [
            'model' => $model,
        ]);
    }

    public function actionCheckOut($id = 0)
    {
//        $this->layout = 'painting-layout';
        $model = Place::findone($id);


        $user = User::findOne(user()->id);

        return $this->render('check_out', [
            'model' => $model,
            'user' => $user,
        ]);
    }

}

