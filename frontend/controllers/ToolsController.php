<?php

namespace frontend\controllers;

use common\enums\ActiveInactiveStatus;
use common\enums\Constents;
use common\enums\PaintingToolType;
use common\models\Category;
use common\models\ProductFrames;
use common\models\search\ProductFramesSearch;
use common\models\User;
use Yii;
use common\models\Product;
use common\models\search\ProductSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use common\enums\PlaceType;
use yii\filters\AccessControl;



/**
 * ProductController implements the CRUD actions for Product model.
 */
class ToolsController extends \common\utils\Controller
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
                        'actions' => ['index', 'tool-details'],
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {

//        $this->layout = 'painting-layout';
        $searchModel = new ProductSearch();
        $query = Category::find()->andWhere(['status' =>ActiveInactiveStatus::active]);
        $categoriesDataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 6,

            ],
        ]);
        $tools_offers = Product::find()
            ->andWhere(['product.type' => PaintingToolType::tool])
            ->andWhere(['product.status' => ActiveInactiveStatus::active])
            ->andWhere(['product.has_offer' => 1])
            ->all();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'categoriesDataProvider' => $categoriesDataProvider,
            'tools_offers' => $tools_offers,


        ]);
    }

    public function actionToolDetails($id = 0)
    {
        $tool = Product::find()
            ->andWhere(['status' => ActiveInactiveStatus::active])
            ->andWhere(['id' => $id])
            ->one();


        return $this->render('toolDetails', [
            'model' => $tool,
//            'productsDataProvider' => $productsDataProvider,
//            'type'=> $id,

        ]);
    }

    public function actionCheckOut($id = 0)
    {
        $model = Product::findone($id);
        $user = User::findOne(user()->id);

        return $this->render('check_out', [
            'model' => $model,
            'user' => $user,
        ]);
    }

}
