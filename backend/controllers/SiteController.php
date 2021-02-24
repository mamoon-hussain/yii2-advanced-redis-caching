<?php

namespace backend\controllers;

use common\enums\ActiveInactiveStatus;
use common\enums\AdminType;
use common\enums\Constents;
use common\enums\PaintingToolType;
use common\enums\PlaceType;
use common\models\Admin;
//use common\models\BranchRooms;
//use common\models\generated\search\RegionSearch;
use common\models\generated\search\UserMobileEmailSearch;
use common\models\generated\search\ZUserMobileEmailSearch;
//use common\models\GenericCourse;
//use common\models\Region;
//use common\models\State;
use common\models\Place;
//use FFMpeg\Coordinate\Dimension;
//use FFMpeg\Coordinate\TimeCode;
//use FFMpeg\Format\Video\WebM;
//use FFMpeg\Format\Video\WMV;
//use FFMpeg\Format\Video\X264;
use common\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use common\models\generated\Contact;
use common\models\ContactForm;
use webvimark\modules\UserManagement\models\ZAdmin;
use webvimark\modules\UserManagement\libs\AdminService;
use common\models\Product;
//use common\services\LibFacebookPage;
//use FFMpeg\FFMpeg;

//include_once (Yii::getAlias('@backend') . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'phpmailer' . DIRECTORY_SEPARATOR.'phpmailer'.DIRECTORY_SEPARATOR.'class.phpmailer.php');

class SiteController extends \common\utils\Controller {

    public $configFiles = 'config_files';

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['error', 'contact', 'lang', 'auth','test-email', 'test-player'
                             ],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index', 'config', 'process-video'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['confirmation-codes'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function($rule, $action) {
                            return true;
                        }
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
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'facebookLogin'],
            ],
        ];
    }

    public function facebookLogin($client) {
        $attributes = $client->getUserAttributes();

        $auth = ZAdmin::find()->where([
                    'facebook_id' => $attributes['id'],
                ])->one();
        $accessToken = $client->getAccessToken()->getToken();

        $accept = FALSE;
        if ($auth) { // login
            $attributes['access_token'] = $accessToken;
            $this->updateUserInfo($auth, $attributes);
            $accept = TRUE;
        } else { // signup
            if ($attributes['email'] !== null && ZAdmin::find()->where(['email' => $attributes['email']])->exists()) {
                stopv('email already used');
            } else {
                $password = Yii::$app->security->generateRandomString(6);
                list($res, $auth, $msg) = AdminService::profileCreate([
                            'username' => $attributes['name'],
                            'email' => isset($attributes['email']) ? $attributes['email'] : $attributes['id'] . '@facebook.com',
                            'facebook_id' => $attributes['id'],
                            'facebook_name' => $attributes['name'],
                            'facebook_email' => $attributes['email'],
                            'facebook_access_token' => $accessToken,
                            'created_at' => time(),
                            'updated_at' => time(),
                            'password' => $password,
                ]);
                if ($res) {
                    $accept = TRUE;
                } else {
                    stopv($msg);
                }
            }
        }

        if ($accept) {
            Yii::$app->user->login($auth);
        }
    }

    private function updateUserInfo($user, $attributes) {
        $user['facebook_name'] = $attributes['name'];
        $user['facebook_access_token'] = $attributes['access_token'];
        $user['facebook_id'] = $attributes['id'];
        if (isset($attributes['email'])) {
            $user['email'] = isset($attributes['email']) ? $attributes['email'] : $attributes['id'] . '@facebook.com';
        }
        if (!$user->save()) {
            stopv($user->errors);
        }
        return TRUE;
    }

    public function actionIndex() {

        $paintingsNumber = Product::find()
            ->andWhere(['type' => PaintingToolType::painting])
            ->andWhere(['status'=>ActiveInactiveStatus::active])
            ->count();

        $toolsNumber = Product::find()
            ->andWhere(['type' => PaintingToolType::tool])
            ->andWhere(['status'=>ActiveInactiveStatus::active])
            ->count();

        $coursesNumber = Place::find()
            ->andWhere(['type' => PlaceType::course])
            ->andWhere(['status'=>ActiveInactiveStatus::active])
            ->count();

        $hallsnumber = Place::find()
            ->andWhere(['type' => PlaceType::hall])
            ->andWhere(['status'=>ActiveInactiveStatus::active])
            ->count();

        $packagesNumber = Place::find()
            ->andWhere(['type' => PlaceType::package])
            ->andWhere(['status'=>ActiveInactiveStatus::active])
            ->count();

        return $this->render('index', [
            'paintingsNumber' => $paintingsNumber,
            'toolsNumber' => $toolsNumber,
            'coursesNumber' => $coursesNumber,
            'hallsnumber' => $hallsnumber,
            'packagesNumber' => $packagesNumber,
        ]);
    }

    public function actionConfig() {
        if (!\webvimark\modules\UserManagement\models\User::hasRole(["Admin"])) {
            throw new NotFoundHttpException('Forbidden.');
        }
        $contact = Contact::findOne(1);

        $post = Yii::$app->request->post();
        if ($post) {
            $contact->email = $post['config']['contact_email'];
            if (!$contact->save()) {
                stopv($contact->errors);
            }

            \Yii::$app->getSession()->setFlash('flash_success', t("Saved"));
            return $this->refresh();
        } else {
            return $this->render('config', [
                        'contact' => $contact,
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

    public function actionLang($l = 'en') {
        Yii::$app->session->set('lang', $l);
        Yii::$app->getResponse()->redirect(Yii::$app->request->referrer);
        return;
//        return $this->redirect(['index']);
    }


    public function actionTestEmail($r) {
        $send = Yii::$app->mailer->compose()
            ->setFrom('rosit.application@gmail.com')
            ->setTo($r)
            ->setSubject('Test Message')
            ->setTextBody('Plain text content. YII2 Application')
            ->setHtmlBody('<b>HTML content <i>Ram Pukar</i></b>')
            ->send();
        if($send){
            stopv('success');
        } else {
            stopv('error');
        }
    }

    public function actionConfirmationCodes()
    {
        $searchModel = new UserMobileEmailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('confrimation_codes', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionTestPlayer()
    {
        return $this->render('test_player', [
        ]);
    }

    public function actionProcessVideo()
    {
        $binaries_dir = Yii::getAlias('@backend') . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'ffmpeg' . DIRECTORY_SEPARATOR . 'ffmpeg' . DIRECTORY_SEPARATOR . 'bin' . DIRECTORY_SEPARATOR;
        $ffmpeg = FFMpeg::create(array(
            'ffmpeg.binaries'  => $binaries_dir.'ffmpeg.exe',
            'ffprobe.binaries' => $binaries_dir.'ffprobe.exe',
            //'timeout'          => 3600, // The timeout for the underlying process
            //'ffmpeg.threads'   => 12,   // The number of threads that FFMpeg should use
        ));
        $dir = Yii::getAlias('@backend') . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'test_video' . DIRECTORY_SEPARATOR;
        $video = $ffmpeg->open($dir."1.mp4");
        $video
            ->filters()
            ->resize(new Dimension(320, 240))
            ->synchronize();
        $video
            ->frame(TimeCode::fromSeconds(10))
            ->save($dir.'frame.jpg');
        $video
            ->save(new X264(), $dir.'export-x264.mp4')
            ->save(new WMV(), $dir.'export-wmv.wmv')
            ->save(new WebM(), $dir.'export-webm.webm');

        stopv('done');
    }



}

