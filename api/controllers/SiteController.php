<?php

namespace api\controllers;

use Yii;
use yii\filters\AccessControl;
use common\utils\Controller;
use yii\filters\VerbFilter;
use common\services\UserService;
use yii\helpers\Url;
use yii2mod\swagger\OpenAPIRenderer;
use yii2mod\swagger\SwaggerUIRenderer;

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
                        'actions' => ['index', 'error', 'captcha', 'docs', 'json-schema'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index2'],
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
            'docs' => [
                'class' => SwaggerUIRenderer::class,
                'restUrl' => Url::to(['site/json-schema']),
            ],
            'json-schema' => [
                'class' => OpenAPIRenderer::class,
                // Тhe list of directories that contains the swagger annotations.
                'scanDir' => [
                    Yii::getAlias('@api/controllers'),
                    Yii::getAlias('@api/models'),
                ],
            ],
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex() {

        return $this->render('index', [
        ]);
    }


}
