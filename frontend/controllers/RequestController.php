<?php

namespace frontend\controllers;

use common\enums\ClassPeriod;
use common\enums\Constents;
use common\enums\PaymentMethod;
use common\enums\RequestEnums;
use common\enums\RequestStatus;
use common\enums\RequestTypes;
use common\models\AppInfo;
use common\models\notifications\Notification;
use common\models\notifications\request\NewRequestNotification;
use common\models\Place;
use common\models\RequestDates;
use common\services\EmailService;
use common\services\PaymentService;
use Yii;
use common\models\Request;
use common\models\search\RequestSearch;
use yii\filters\AccessControl;
use yii\helpers\Url;
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
                        'actions' => ['index', 'view', 'product-check-out', 'course-check-out', 'package-check-out',
                            'hall-check-out'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['payment-response'],
                        'allow' => true,
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

    public function actionIndex()
    {
        $searchModel = new RequestSearch();
        $searchModel->user_id = userId();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
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

    protected function findModel($id)
    {
        $model = Request::findOne($id);
        if ($model && $model->user_id == userId()) {
            return $model;
        }

        throw new NotFoundHttpException(t('The requested page does not exist.'));
    }



    public function actionPaymentResponse($id=0)
    {
        $post = Yii::$app->request->post();
        $get = Yii::$app->request->get();
        $model = Request::findOne($id);
        if(!$model){
            stopv($get);
        }
        if(isset($get['Result'])){
            $model->payment_result = $get['Result'];
        }
        $model->payment_data = json_encode($get);
        if(!$model->save()){
            stopv($model->errors);
        }
        //send email
        $about = AppInfo::find()->one();
        $email = $about->email;
        if($email){
            PaymentService::sendPaymentEmail($email, $model);
        }
        //
        Yii::$app->session->setFlash('flash_success', t("Saved"));
        return $this->redirect(['/request/index']);
    }

    public function actionProductCheckOut($id = 0)
    {
        $model = new Request();
        $model->product_id = $id;
        $model->user_id = userId();
        $model->fname = \user()->fname;
        $model->lname = \user()->lname;
        $model->email = \user()->email;
        $model->phone = \user()->phone;

        $post = Yii::$app->request->post();
        if($model->load($post)){
            $model->status = RequestStatus::new_request;
            $model->created_date = date(Constents::full_date_format);
            $model->type = RequestTypes::product;
            $model->enums = $model->product->type;
            $model->price = $model->product->price;
            $model->price_unit_number = 1;

            if(isset($post['payment_method_'.PaymentMethod::paypal])){
                $model->payment_method = PaymentMethod::paypal;
            }
            if(isset($post['payment_method_'.PaymentMethod::cash])){
                $model->payment_method = PaymentMethod::cash;
            }

            if(!$model->save()){
                stopv($model->errors);
            }

            /**
             * Send Notification
             */
            Notification::send(new NewRequestNotification($model));

            //send email
            $emailCompose = Yii::$app->mailer->compose('/email/checkout', ['model' => $model]);
            $email_title = RequestEnums::LabelOf($model->enums).' Checkout';
            $email_sent = EmailService::sendNotificationEmail($emailCompose, $email_title);
            //

            switch ($model->payment_method){
                case PaymentMethod::paypal:
                    //start payment
                    $redirect_url = PaymentService::payment($model, $model->product->name);
                    if($redirect_url){
                        return \Yii::$app->controller->redirect($redirect_url);
                    } else {
                        Yii::$app->session->setFlash('flash_error', t("Payment data are not valid"));
                    }
                    break;

                default:
                    Yii::$app->session->setFlash('flash_success', t("Saved"));
                    break;
            }
            return $this->redirect(['/request/index']);
        }

        return $this->render('painting_check_out', [
            'model' => $model,
        ]);
    }

    public function actionCourseCheckOut($id = 0)
    {
        $course = Place::findOne($id);
        if(!$course){
            throw new NotFoundHttpException(t('The requested page does not exist.'));
        }
        if($course->seats_number <= $course->requestsNumber){
            Yii::$app->session->setFlash('flash_error', t("Class is full"));
            return $this->redirect(['/courses/offline-training']);
        }
        if($course->isRequested){
            Yii::$app->session->setFlash('flash_error', t("Already requested"));
            return $this->redirect(['/courses/offline-training']);
        }

        $model = new Request();
        $model->place_id = $id;
        $model->user_id = userId();
        $model->fname = \user()->fname;
        $model->lname = \user()->lname;
        $model->email = \user()->email;
        $model->phone = \user()->phone;

        $post = Yii::$app->request->post();
        if($model->load($post)){
            $model->status = RequestStatus::new_request;
            $model->created_date = date(Constents::full_date_format);
            $model->type = RequestTypes::place;
            $model->enums = $model->place->type;
            $model->price = $model->place->price;
            $model->price_unit_number = 1;

            if(isset($post['payment_method_'.PaymentMethod::paypal])){
                $model->payment_method = PaymentMethod::paypal;
            }
            if(isset($post['payment_method_'.PaymentMethod::cash])){
                $model->payment_method = PaymentMethod::cash;
            }

            if(!$model->save()){
                stopv($model->errors);
            }

            /**
             * Send Notification
             */
            Notification::send(new NewRequestNotification($model));

            //send email
            $emailCompose = Yii::$app->mailer->compose('/email/checkout', ['model' => $model]);
            $email_title = RequestEnums::LabelOf($model->enums).' Checkout';
            $email_sent = EmailService::sendNotificationEmail($emailCompose, $email_title);
            //

            switch ($model->payment_method){
                case PaymentMethod::paypal:
                    //start payment
                    $redirect_url = PaymentService::payment($model, $model->product_id ? $model->product->name : $model->place->name);
                    if($redirect_url){
                        return \Yii::$app->controller->redirect($redirect_url);
                    } else {
                        Yii::$app->session->setFlash('flash_error', t("Payment data are not valid"));
                    }
                    break;

                default:
                    Yii::$app->session->setFlash('flash_success', t("Saved"));
                    break;
            }
            return $this->redirect(['/request/index']);
        }

        return $this->render('course_check_out', [
            'model' => $model,
            'course' => $course,
        ]);
    }

    public function actionPackageCheckOut()
    {
        $model = new Request();
        $get = Yii::$app->request->get();
        $model->load($get);
        $model->price_unit_number = 1;
        if(!$model->place_id || !$model->price_unit_number || !$model->start_date){
            Yii::$app->session->setFlash('flash_error', t("Please fill all fields"));
            return $this->redirect(['/packages/index', $get]);
        }
        if($model->start_date < date(Constents::full_date_format)){
            Yii::$app->session->setFlash('flash_error', t("Date not valied"));
            return $this->redirect(['/packages/index',$get]);
        }

        $requested = Request::find()
            ->andWhere(['place_id' => $model->place_id])
            ->andWhere(['or',
                ['in', 'status', [RequestStatus::under_process, RequestStatus::done]],
                ['payment_result' => 'CAPTURED']
            ])
            ->andWhere(['like', 'start_date', $model->start_date])
            ->one();
        if($requested){
            Yii::$app->session->setFlash('flash_error', t("Table already reserved in the selected date!"));
            return $this->redirect(['/packages/index',$get]);
        }

        $artTable = Place::findOne($model->place_id);
        if(!$artTable){
            throw new NotFoundHttpException(t('The requested page does not exist.'));
        }

        $model->user_id = userId();
        $model->fname = \user()->fname;
        $model->lname = \user()->lname;
        $model->email = \user()->email;
        $model->phone = \user()->phone;

        $post = Yii::$app->request->post();
        if($model->load($post)){
            $model->status = RequestStatus::new_request;
            $model->created_date = date(Constents::full_date_format);
            $model->type = RequestTypes::place;
            $model->enums = $model->place->type;
            $model->price = $model->place->price;

            if(isset($post['payment_method_'.PaymentMethod::paypal])){
                $model->payment_method = PaymentMethod::paypal;
            }
            if(isset($post['payment_method_'.PaymentMethod::cash])){
                $model->payment_method = PaymentMethod::cash;
            }

            if(!$model->save()){
                stopv($model->errors);
            }

            /**
             * Send Notification
             */
            Notification::send(new NewRequestNotification($model));

            //send email
            $emailCompose = Yii::$app->mailer->compose('/email/checkout', ['model' => $model]);
            $email_title = RequestEnums::LabelOf($model->enums).' Checkout';
            $email_sent = EmailService::sendNotificationEmail($emailCompose, $email_title);
            //

            switch ($model->payment_method){
                case PaymentMethod::paypal:
                    //start payment
                    $redirect_url = PaymentService::payment($model, $model->product_id ? $model->product->name : $model->place->name);
                    if($redirect_url){
                        return \Yii::$app->controller->redirect($redirect_url);
                    } else {
                        Yii::$app->session->setFlash('flash_error', t("Payment data are not valid"));
                    }
                    break;

                default:
                    Yii::$app->session->setFlash('flash_success', t("Saved"));
                    break;
            }
            return $this->redirect(['/request/index']);
        }

        return $this->render('package_check_out', [
            'model' => $model,
            'place' => $artTable,
        ]);
    }

    public function actionHallCheckOut()
    {
        $model = new Request();
        $get = Yii::$app->request->get();
        if(isset($get['Request']['place_id'])){
            $get['id'] = $get['Request']['place_id'];
        }
        $model->load($get);
        if(!$model->dates){
            Yii::$app->session->setFlash('flash_error', t("You didn't select any date!"));
            return $this->redirect(['/halls/details',$get]);
        }
        $requestDates = [];
        foreach ($model->dates as $one){
            $date_period = explode('_', $one);
            $request_date = new RequestDates();
            $request_date->date = date(Constents::full_date_format, $date_period[0]);
            $request_date->period = $date_period[1];

            $requestDates[] = $request_date;
        }



//        $standard = array("0","1","2","3","4","5","6","7","8","9");
//        $eastern_arabic_symbols = array("٠","١","٢","٣","٤","٥","٦","٧","٨","٩");
//
//        $model->start_date = str_replace($eastern_arabic_symbols,  $standard, $model->start_date);
//        $model->end_date = str_replace($eastern_arabic_symbols,  $standard, $model->end_date);
//        $start_time = strtotime($model->start_date);
//        $end_time = strtotime($model->end_date);
//        $datediff = $end_time - $start_time;
//        $model->price_unit_number = (int)round($datediff / (60 * 60 * 24)) + 1;
//        if(!$model->place_id || !$model->price_unit_number || !$model->start_date || !$model->class_period){
//            Yii::$app->session->setFlash('flash_error', t("Please fill all fields"));
//            return $this->redirect(['/halls/details', $get]);
//        }
//        if($model->start_date < date(Constents::full_date_format)){
//            Yii::$app->session->setFlash('flash_error', t("Date not valied"));
//            return $this->redirect(['/halls/details',$get]);
//        }

//        $requested = Request::find()
//            ->andWhere(['place_id' => $model->place_id])
//            ->andWhere(['or',
//                ['in', 'status', [RequestStatus::under_process, RequestStatus::done]],
//                ['payment_result' => 'CAPTURED']
//            ])
//            ->andWhere(['like', 'start_date', $model->start_date])
//            ->andWhere(['class_period' => $model->class_period])
//            ->one();
//        if($requested){
//            Yii::$app->session->setFlash('flash_error', t("Class already reserved in the selected date!"));
//            return $this->redirect(['/halls/details',$get]);
//        }

        $place = Place::findOne($model->place_id);
        if(!$place){
            throw new NotFoundHttpException(t('The requested page does not exist.'));
        }

        $model->user_id = userId();
        $model->fname = \user()->fname;
        $model->lname = \user()->lname;
        $model->email = \user()->email;
        $model->phone = \user()->phone;

        $post = Yii::$app->request->post();
        if($model->load($post)){
            $model->status = RequestStatus::new_request;
            $model->created_date = date(Constents::full_date_format);
            $model->type = RequestTypes::place;
            $model->enums = $model->place->type;

            $model->price = $model->place->price;
            if($model->class_period == ClassPeriod::afternoon_period){
                $model->price = $model->place->price_2;
            }


            if(isset($post['payment_method_'.PaymentMethod::paypal])){
                $model->payment_method = PaymentMethod::paypal;
            }
            if(isset($post['payment_method_'.PaymentMethod::cash])){
                $model->payment_method = PaymentMethod::cash;
            }

            if(!$model->save()){
                stopv($model->errors);
            }

            foreach ($requestDates as $one){
                $one->request_id = $model->id;
                if(!$one->save()){
                    stopv($one->errors);
                }
            }

            /**
             * Send Notification
             */
            Notification::send(new NewRequestNotification($model));

            //send email
            $emailCompose = Yii::$app->mailer->compose('/email/checkout', ['model' => $model]);
            $email_title = RequestEnums::LabelOf($model->enums).' Checkout';
            $email_sent = EmailService::sendNotificationEmail($emailCompose, $email_title);
            //

            switch ($model->payment_method){
                case PaymentMethod::paypal:
                    //start payment
                    $redirect_url = PaymentService::payment($model, $model->product_id ? $model->product->name : $model->place->name);
                    if($redirect_url){
                        return \Yii::$app->controller->redirect($redirect_url);
                    } else {
                        Yii::$app->session->setFlash('flash_error', t("Payment data are not valid"));
                    }
                    break;

                default:
                    Yii::$app->session->setFlash('flash_success', t("Saved"));
                    break;
            }
            return $this->redirect(['/request/index']);
        }

        return $this->render('hall_check_out', [
            'model' => $model,
            'place' => $place,
            'requestDates' => $requestDates,
        ]);
    }



}
