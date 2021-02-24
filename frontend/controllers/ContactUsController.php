<?php

namespace frontend\controllers;

use common\enums\ActiveInactiveStatus;
use common\enums\Constents;
use common\enums\ContactUsStatus;
use common\enums\PaintingToolType;
use common\models\AppInfo;
use common\models\ContactForm;
use common\models\ContactUs;
use common\models\generated\Contact;
use common\models\ProductFrames;
use common\models\search\ProductFramesSearch;
use Yii;
use common\models\Product;
use common\models\search\ProductSearch;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use common\enums\PlaceType;


/**
 * ProductController implements the CRUD actions for Product model.
 */
class ContactUsController extends \common\utils\Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index'],
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


//    public function actionIndex() {
//        $model = new ContactForm();
//
//        $email = Contact::findOne(1)->email;
//        $post = Yii::$app->request->post();
//        if ($model->load($post)) {
//            if ($model->sendEmail($email)) {
//                Yii::$app->session->setFlash('flash_success', 'Your massage is received and will be answered shortly.');
//            } else {
//                Yii::$app->session->setFlash('flash_error', 'Error in sending massage, Try again later');
//            }
//            return $this->refresh();
//        } else {
//            return $this->render('index', [
//                'model' => $model,
//            ]);
//        }
//    }

    public function actionIndex() {
        $app_info = AppInfo::find()->one();
        $model = new ContactUs();

        $post = Yii::$app->request->post();
        if ($model->load($post)) {
            $model->create_date = date(Constents::full_date_format);
            $model->status = ContactUsStatus::new_request;
            if ($model->save()) {
                Yii::$app->session->setFlash('flash_success', t('Your massage is received and will be contact you shortly.'));
            } else {
                Yii::$app->session->setFlash('flash_error', t('Error in sending massage, Try again later'));
            }
            return $this->refresh();
        } else {
            return $this->render('index', [
                'model' => $model,
                'app_info' => $app_info,
            ]);
        }
    }


}
