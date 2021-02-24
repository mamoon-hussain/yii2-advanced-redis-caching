<?php

namespace frontend\controllers;

use common\enums\ActiveInactiveStatus;
use common\enums\ClassPeriod;
use common\enums\Constents;
use common\enums\PlaceType;
use common\enums\RequestEnums;
use common\enums\RequestStatus;
use common\enums\RequestTypes;
use common\models\PlaceContents;
use common\models\Request;
use common\models\RequestDates;
use common\models\search\PlaceContentsSearch;
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
class HallsController extends \common\utils\Controller
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
                        'actions' => ['index', 'details', 'book-hall', 'jsoncalendar'],
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

    public function beforeAction($action)
    {
        if($action->id == 'jsoncalendar'){
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
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
        $query = Place::find()
            ->andWhere(['place.type' =>PlaceType::hall])
            ->andWhere(['place.status' => ActiveInactiveStatus::active])
        ;
        $hallsDataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,

            ],
        ]);
        $model = new Request();
        $get = Yii::$app->request->get();
        if(isset($get[1])){
            $model->load($get[1]);
        }

        $post = Yii::$app->request->post();

//        if ($model->load($post)) {
////            stopv($model);
//            $model->status = RequestStatus::new_request;
//            $model->created_date = date(Constents::full_date_format);
//            $model->type = RequestTypes::place;
//
//            $model->user_id = user()->id;
//            $model->fname = user()->fname;
//            $model->lname = user()->lname;
//            $model->phone = user()->phone;
//            $model->email = user()->email;
//            $model->enums = RequestEnums::hall;
////            stopv($model);
//            $model->save();
//        }
        //$paintingDataProvider = $searchModel->search(Yii::$app->request->queryParams,$query);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'hallsDataProvider' => $hallsDataProvider,
            'model' => $model,
        ]);
    }

    public function actionDetails($id = 0)
    {
        $request = new Request();
        $request->scenario = 'request_class';

        $get = Yii::$app->request->get();
        if(isset($get[1])){
            $request->load($get[1]);
            $id = $get[1]['id'];
        }
        $hall = Place::find()
            ->andWhere(['status' => ActiveInactiveStatus::active])
            ->andWhere(['id' => $id])
            ->one();


        return $this->render('hallDetails', [
            'model' => $hall,
            'request' => $request,
        ]);
    }

    public function actionJsoncalendar($id)
    {
        $post = Yii::$app->request->post();
        $start = $post['start'];
        $end = $post['end'];
        $alreadyChosen = [];
        if(isset($post['chosen_dates']) && $post['chosen_dates']){
            $chosenDates = explode(',', $post['chosen_dates']);
            foreach ($chosenDates as $one){
                if($one){
                    $date_period = explode('_', $one);
                    $alreadyChosen[$date_period['0']][$date_period['1']] = $one;
                }
            }
        }


        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $events = array();
        $date = $start;
        while ($date <= $end){
            if($date > date('Y-m-d')){
                $afternoon_period_request = RequestDates::find()
                    ->joinWith('request')
                    ->andWhere(['not', ['request.status' => RequestStatus::rejected]])
                    ->andWhere(['like', 'request_dates.date', $date])
                    ->andWhere(['request_dates.period' => ClassPeriod::afternoon_period])
                    ->one();
                if(!$afternoon_period_request){
                    $Event = new \yii2fullcalendar\models\Event();
                    $Event->id = strtotime($date).'_'.ClassPeriod::afternoon_period;
//                    $Event->title = ClassPeriod::LabelOf(ClassPeriod::afternoon_period);
                    $Event->title = 'PM';
                    $Event->start = date('Y-m-d', strtotime($date));
                    if(isset($alreadyChosen[strtotime($date)][ClassPeriod::afternoon_period]) && $alreadyChosen[strtotime($date)][ClassPeriod::afternoon_period]){
                        $Event->color = '#4bff00';
                    }
//            $Event->color = '#eb8505';
                    $events[] = $Event;
                }

                $noon_period_request = RequestDates::find()
                    ->joinWith('request')
                    ->andWhere(['not', ['request.status' => RequestStatus::rejected]])
                    ->andWhere(['like', 'date', $date])
                    ->andWhere(['period' => ClassPeriod::noon_period])
                    ->one();
                if(!$noon_period_request){
                    $Event = new \yii2fullcalendar\models\Event();
                    $Event->id = strtotime($date).'_'.ClassPeriod::noon_period;
//                    $Event->title = ClassPeriod::LabelOf(ClassPeriod::noon_period);
                    $Event->title = 'AM';
                    $Event->start = date('Y-m-d', strtotime($date));
                    if(isset($alreadyChosen[strtotime($date)][ClassPeriod::noon_period]) && $alreadyChosen[strtotime($date)][ClassPeriod::noon_period]){
                        $Event->color = '#4bff00';
                    } else {
                        $Event->color = '#e3dc00';
                    }
                    $events[] = $Event;
                }
            }

            $date = date('Y-m-d', strtotime($date . ' + 1 days'));
        }

        return $events;
    }

    public function actionBookHall($id = 0)
    {
        $searchModel = new PlaceSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $query = Place::find()
            ->andWhere(['place.type' =>PlaceType::hall])
            ->andWhere(['place.status' => ActiveInactiveStatus::active])
        ;
        $hallsDataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,

            ],
        ]);
        $model = new Request();
        $get = Yii::$app->request->get();
        if(isset($get[1])){
            $model->load($get[1]);
        }

        $post = Yii::$app->request->post();

//        if ($model->load($post)) {
////            stopv($model);
//            $model->status = RequestStatus::new_request;
//            $model->created_date = date(Constents::full_date_format);
//            $model->type = RequestTypes::place;
//
//            $model->user_id = user()->id;
//            $model->fname = user()->fname;
//            $model->lname = user()->lname;
//            $model->phone = user()->phone;
//            $model->email = user()->email;
//            $model->enums = RequestEnums::hall;
////            stopv($model);
//            $model->save();
//        }
        //$paintingDataProvider = $searchModel->search(Yii::$app->request->queryParams,$query);
        return $this->render('book_hall', [
            'searchModel' => $searchModel,
            'hallsDataProvider' => $hallsDataProvider,
            'model' => $model,
            'id' => $id,
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

