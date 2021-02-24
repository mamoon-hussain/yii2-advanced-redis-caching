<?php

namespace frontend\controllers;

use common\enums\ActiveInactiveStatus;
use common\enums\Constents;
use common\enums\PaintingToolType;
use common\models\Category;
use common\models\ProductFrames;
use common\models\search\ProductFramesSearch;
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
class CategoryController extends \common\utils\Controller
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
                        'actions' => ['category-tools'],
                        'allow' => true,
                    ],
                    [
                        'actions' => [''],
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
    public function actionCategoryTools($id = 0)
    {

//        $this->layout = 'painting-layout';
        $category = Category::findOne($id);
        $tools_offers = Product::find()
            ->andWhere(['product.type' => PaintingToolType::tool])
            ->andWhere(['product.status' => ActiveInactiveStatus::active])
            ->andWhere(['product.has_offer' => 1])
            ->andWhere(['product.category_id' => $id])
            ->all();

        return $this->render('categoryTools', [
            'tools_offers' => $tools_offers,
            'category' => $category,
        ]);
    }

}
