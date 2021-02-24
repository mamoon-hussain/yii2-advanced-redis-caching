<?php

namespace frontend\controllers;

use common\enums\ClassPeriod;
use common\enums\Constents;
use common\enums\OrderStatus;
use common\enums\PaintingToolType;
use common\enums\PlaceType;
use common\enums\RequestEnums;
use common\enums\RequestStatus;
use common\enums\RequestTypes;
use common\models\AppInfo;
use common\models\CommonQuestion;
use common\models\notifications\Notification;
use common\models\notifications\request\NewRequestNotification;
use common\models\Product;
use common\models\Place;
use common\models\Request;
use common\models\search\CommonQuestionSearch;
use common\models\search\ProductSearch;
use common\models\search\PlaceSearch;
use common\models\UserOrder;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use common\utils\Controller;
use yii\filters\VerbFilter;
use common\models\ContactForm;
use common\models\generated\Contact;
//use common\models\AboutUs;
use webvimark\modules\UserManagement\models\ZUser;
use webvimark\modules\UserManagement\libs\LibUser;
use yii\helpers\Url;
//use yii2mod\swagger\OpenAPIRenderer;
//use yii2mod\swagger\SwaggerUIRenderer;
use common\models\Faq;
use common\enums\ActiveInactiveStatus;
use common\models\Slider;
use yii2mod\moderation\enums\Status;

class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'error', 'contact', 'captcha', 'about', 'lang', 'auth','faqs',
                            'blowerdoor-test','aushilfskrafte', 'create-place-request', 'create-product-request',
                            'table-reservation-request','hall-reservation-request','test-payment', 'success-test-payment',
                            'failed-test-payment', 'get-place-image', 'get-place-price', 'get-hall-price', 'terms'],
                        'allow' => true,
                    ],
                    [
                        'actions' => [''],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'facebookLogin'],
            ],
        ];
    }

    public function actionIndex($cat=1,$t=0)
    {
        $app_info = AppInfo::find()->one();
            //stopv(user());
//        //$faqModel = Faq::find()->where(['=', 'status', ActiveInactiveStatus::active])->limit(5)->all();
//        //$sliderModel = Slider::find()->where(['=', 'status', ActiveInactiveStatus::active])->all();
//
//        return $this->render('index', [
//            //'faqModel'      =>          $faqModel,
//            //'sliderModel'  =>          $sliderModel
//        ]);
        if($cat==1)
        {
            $searchModel = new ProductSearch();
            //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $query = Product::find()->andWhere(['product.type' => $t,'product.status' =>ActiveInactiveStatus::active]);
            $productsDataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => 5,

                ],
            ]);
            //$paintingDataProvider = $searchModel->search(Yii::$app->request->queryParams,$query);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'productsDataProvider' => $productsDataProvider,
                'category' => $cat,
                'type'=> $t,
                'app_info'=> $app_info,

            ]);
        }

        else
        {
            $searchModel = new PlaceSearch();
            //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $query = Place::find()->andWhere(['place.type' => $t]);
            $placesDataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => 5,

                ],
            ]);
            //$paintingDataProvider = $searchModel->search(Yii::$app->request->queryParams,$query);
            return $this->render('index', [
                'searchModel' => $searchModel,
                'placesDataProvider' => $placesDataProvider,
                'category' => $cat,
                'type'=> $t,
                'app_info'=> $app_info,
            ]);
        }
    }


    public function actionContact() {
        $model = new ContactForm();
        $email = Contact::findOne(1)->email;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail($email)) {
                Yii::$app->session->setFlash('flash_success', 'Your massage is received and will be answered shortly.');
            } else {
                Yii::$app->session->setFlash('flash_error', 'Error in sending massage, Try again later');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

        public function actionAushilfskrafte() {
        $model = new ContactForm();
        $email = Contact::findOne(1)->email;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail($email, 'Aushilfkrafte')) {
                Yii::$app->session->setFlash('flash_success', 'Your massage is received and will be answered shortly.');
            } else {
                Yii::$app->session->setFlash('flash_error', 'Error in sending massage, Try again later');
            }

            return $this->refresh();
        } else {
            return $this->render('contact_2', [
                        'model' => $model,
            ]);
        }
    }
    
    
        public function actionBlowerdoorTest() {
        $model = new ContactForm();
        $email = Contact::findOne(1)->email;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail($email ,'BlowerDoor Test')) {
                Yii::$app->session->setFlash('flash_success', 'Your massage is received and will be answered shortly.');
            } else {
                Yii::$app->session->setFlash('flash_error', 'Error in sending massage, Try again later');
            }

            return $this->refresh();
        } else {
            return $this->render('contact_2', [
                        'model' => $model,
            ]);
        }
    }
    
    
    public function actionLang($l = 'en') {
        Yii::$app->session->set('lang', $l);
        Yii::$app->getResponse()->redirect(Yii::$app->request->referrer);
        return;
//        return $this->redirect(['index']);
    }

    public function facebookLogin($client) {
//        $attributes = $client->getUserAttributes();
//
//        $auth = ZUser::find()
//                ->where(['facebook_id' => $attributes['id']])
//                ->orWhere(['email' => $attributes['email']])
//                ->one();
//        $accessToken = $client->getAccessToken()->getToken();
//
//        $accept = FALSE;
//        if ($auth) { // login
//            $attributes['access_token'] = $accessToken;
//            $this->updateUserInfo($auth, $attributes);
//            $accept = TRUE;
//        } else { // signup
//            if ($attributes['email'] !== null && ZUser::find()->where(['email' => $attributes['email']])->exists()) {
//                stopv('email already used');
//            } else {
//                $password = Yii::$app->security->generateRandomString(6);
//                list($res, $auth, $msg) = LibUser::profileFbCreate([
//                            'username' => $attributes['name'],
//                            'email' => isset($attributes['email']) ? $attributes['email'] : $attributes['id'] . '@facebook.com',
//                            'facebook_id' => $attributes['id'],
//                            'facebook_name' => $attributes['name'],
//                            'facebook_email' => $attributes['email'],
//                            'facebook_access_token' => $accessToken,
//                            'created_at' => time(),
//                            'updated_at' => time(),
//                            'password' => $password,
//                ]);
//                if ($res) {
//                    $accept = TRUE;
//                } else {
//                    stopv($msg);
//                }
//            }
//        }
//
//        if ($accept) {
//            Yii::$app->user->login($auth);
//        }
    }

    private function updateUserInfo($user, $attributes) {
//        $user['facebook_name'] = $attributes['name'];
//        $user['username'] = $attributes['name'];
//        $user['facebook_access_token'] = $attributes['access_token'];
//        $user['facebook_id'] = $attributes['id'];
//        if (isset($attributes['email'])) {
//            $user['email'] = isset($attributes['email']) ? $attributes['email'] : $attributes['id'] . '@facebook.com';
//        }
//
//        if (!$user->save()) {
//            stopv($user->errors);
//        }
//        return TRUE;
    }

    public  function actionAbout()
    {
        $model = AppInfo::find()->one();
        return $this->render('about', [
            'model' => $model,
        ]);
    }

    public  function actionTerms()
    {
        $model = AppInfo::findOne(2);
        return $this->render('terms', [
            'model' => $model,
        ]);
    }

    public function actionFaqs()
    {
        $searchModel = new CommonQuestionSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $query = CommonQuestion::find()
            ->andWhere(['common_question.status' => ActiveInactiveStatus::active]);

        $faqsDataProvider = $searchModel->faqs_search(Yii::$app->request->queryParams,$query);

        return $this->render('faqs', [
            'searchModel' => $searchModel,
            'faqsDataProvider' => $faqsDataProvider,
        ]);
    }

    public function actionCreatePlaceRequest($id = 0)
    {
        $model = Place::findOne($id);
        $request = new Request();
        $request->user_id = user()->id;
        $request->status = RequestStatus::new_request;
        $request->place_id = $model->id;
        $request->created_date = date(Constents::full_date_format);

        $request->fname = user()->fname;
        $request->lname = user()->lname;
        $request->phone = user()->phone;
        $request->email = user()->email;
        $request->type = RequestTypes::place;
        if($model->type == PlaceType::course){

            $request->enums = RequestEnums::course;
        } elseif($model->type == PlaceType::hall){
            $request->enums = RequestEnums::hall;
        } else{
            $request->enums = RequestEnums::package;
        }

        $request->save();

        return $this->render('index', [
        ]);
    }



    public function actionTableReservationRequest()
    {
        stopv(Yii::$app->request->post());
//        $model = Product::findOne($id);
        $request = new Request();
        $request->user_id = user()->id;
        $request->status = RequestStatus::new_request;
        $request->product_id = $model->id;
        $request->created_date = date(Constents::full_date_format);

        $request->fname = user()->fname;
        $request->lname = user()->lname;
        $request->phone = user()->phone;
        $request->email = user()->email;
        $request->type = RequestTypes::product;
        if($model->type == PaintingToolType::painting){
            $request->enums = RequestEnums::painting;
        } else{
            $request->enums = RequestEnums::tool;
        }

        $request->save();

        return $this->render('index', [
        ]);
    }

    public function actionHallReservationRequest($id = 0)
    {
        stopv('post');
        $model = Product::findOne($id);
        $request = new Request();
        $request->user_id = user()->id;
        $request->status = RequestStatus::new_request;
        $request->product_id = $model->id;
        $request->created_date = date(Constents::full_date_format);

        $request->fname = user()->fname;
        $request->lname = user()->lname;
        $request->phone = user()->phone;
        $request->email = user()->email;
        $request->type = RequestTypes::product;
        if($model->type == PaintingToolType::painting){
            $request->enums = RequestEnums::painting;
        } else{
            $request->enums = RequestEnums::tool;
        }

        $request->save();

        return $this->render('index', [
        ]);
    }

    public function actionTestPayment()
    {
        $fields = array(
            'merchant_id'=>'1201',
            'username' => 'test',
            'password'=>stripslashes('test'),
            'api_key'=>'jtest123', // in sandbox request
            //'api_key' =>password_hash('API_KEY',PASSWORD_BCRYPT), //In production mode, please pass API_KEY with BCRYPT function
            'order_id'=>time(), // MIN 30 characters with strong unique function (like hashing function with time)
            'total_price'=>'10',
            'CurrencyCode'=>'KWD',//only works in production mode
            'CstFName'=>'Test Name',
            'CstEmail'=>'test@test.com',
            'CstMobile'=>'12345678',
            'success_url'=>Url::to(['/site/success-test-payment'], true),
            'error_url'=>Url::to(['/site/success-test-payment'], true),
            'test_mode'=>1, // test mode enabled
            'whitelabled'=>true, // only accept in live credentials (it will not work in test)
//            'payment_gateway'=>'knet',// only works in production mode
            'ProductName'=>json_encode(['computer','television']),
            'ProductQty'=>json_encode([2,1]),
            'ProductPrice'=>json_encode([150,1500]),
            'reference'=>'Ref00001'
        );

        $fields_string = http_build_query($fields);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://api.upayments.com/test-payment");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$fields_string);
// receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        $server_output = json_decode($server_output,true);

        stopv($server_output);
        //window.location.href=$server_output[‘paymentURL’]; // javascript
        //header('Location:'.$server_output['paymentURL']); // PHP
    }

    public function actionSuccessTestPayment()
    {
        stopv('success out');
    }

    public function actionFailedTestPayment()
    {
        stopv('failed out');
    }

    public function actionGetPlaceImage($id)
    {
        $model = Place::findOne($id);
        $url = '';
        if($model){
            $url = $model->imageUrl;
        }
        return json_encode(['url' => $url]);
    }

    public function actionGetPlacePrice($t='', $d ='')
    {
        if(!$t || !$d){
            return '';
        }
        $model = Place::findOne($t);
        $text = '';
        if($model){
            $text = $model->price.' '.t('KD').' '.t('for one month').' '
                .t('From: ').date('M-d', strtotime($d))
                .' - '.t('Until: ')
                .date('M-d', strtotime($d . ' + 1 months - 1 days'));
        }
        return json_encode(['text' => $text]);
    }

//    public function actionGetHallPrice($h='', $p ='', $d='')
//    {
//        if(!$h || !$p || !$d){
//            return '';
//        }
//        $standard = array("0","1","2","3","4","5","6","7","8","9");
//        $eastern_arabic_symbols = array("٠","١","٢","٣","٤","٥","٦","٧","٨","٩");
//        $model = Place::findOne($h);
//        switch ($p){
//            case ClassPeriod::noon_period:
//                $price = $model->price;
//                break;
//
//            case ClassPeriod::noon_period:
//                $price = $model->price_2;
//                break;
//
//            default:
//                $price = $model->price;
//                break;
//        }
//        $text = '';
//        if($model){
//            $date_range = explode(' - ', $d);
//            $start_date = $date_range[0];
//            $end_date = $date_range[1];
//            $start_date = str_replace($eastern_arabic_symbols,  $standard, $start_date);
//            $end_date = str_replace($eastern_arabic_symbols,  $standard, $end_date);
//            $datediff = strtotime($end_date) - strtotime($start_date);
//            $daysNum = (int)round($datediff / (60 * 60 * 24)) + 1;
//            $text = ($price*$daysNum).' '.t('KD').' - '.ClassPeriod::LabelOf($p).' - '
//                .t('From: ').date('M-d', strtotime($start_date))
//                .' - '.t('Until: ')
//                .date('M-d', strtotime($end_date));
//        }
//        return json_encode(['text' => $text]);
//    }

    public function actionGetHallPrice($h='', $p ='')
    {
        if(!$h || !$p){
            return json_encode(['text' => '']);
        }
        $standard = array("0","1","2","3","4","5","6","7","8","9");
        $eastern_arabic_symbols = array("٠","١","٢","٣","٤","٥","٦","٧","٨","٩");
        $model = Place::findOne($h);
        $days = explode(',', $p);
        $total_price = 0;
        $days_text = '';

        sort($days);
        foreach ($days as $one){
            if($one){
                $day_date_period  = explode('_', $one);
                $time = $day_date_period[0];
                $p = $day_date_period[1];

                switch ($p){
                    case ClassPeriod::noon_period:
                        $price = $model->price;
                        break;

                    case ClassPeriod::noon_period:
                        $price = $model->price_2;
                        break;

                    default:
                        $price = $model->price;
                        break;
                }
                $total_price = $total_price + $price;
                $days_text = $days_text . '<p style="margin-bottom: 5px;">' . date('M-d', $time) . ' - ' . ClassPeriod::LabelOf($p).'</p>';
            }
        }

        $text = ($total_price).' '.t('KD').' - <br/>'
            . $days_text;

        return json_encode(['text' => $text]);
    }

}
