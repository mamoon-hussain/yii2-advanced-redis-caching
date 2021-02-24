<?php

namespace frontend\controllers;

use common\enums\ActiveInactiveStatus;
use common\enums\Constents;
use common\enums\PaintingToolType;
use common\enums\PaymentMethod;
use common\enums\RequestEnums;
use common\enums\RequestStatus;
use common\enums\RequestTypes;
use common\models\ProductFrames;
use common\models\Request;
use common\models\search\ProductFramesSearch;
use common\models\User;
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
class PaintingsController extends \common\utils\Controller
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
                        'actions' => ['index', 'details', 'add-frame'],
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
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $query = Product::find()->andWhere(['product.type' => PaintingToolType::painting,'product.status' =>ActiveInactiveStatus::active]);
        $paintingsDataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => false,

            ],
        ]);
        //$paintingDataProvider = $searchModel->search(Yii::$app->request->queryParams,$query);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'paintingsDataProvider' => $paintingsDataProvider,

        ]);
    }

    public function actionDetails($id = 0)
    {
        $painting = Product::find()
            ->andWhere(['status' => ActiveInactiveStatus::active])
            ->andWhere(['id' => $id])
            ->one();

        if(!$painting){
            throw new NotFoundHttpException(t('The requested page does not exist.'));
        }

        $frames = $painting->productFrames;

        $request = Request::find()
            ->andWhere(['product_id' => $id])
            ->andWhere(['or',
                ['in', 'status', [RequestStatus::under_process, RequestStatus::done]],
                ['payment_result' => 'CAPTURED']
//                ['and', ['payment_method' => PaymentMethod::paypal], ['not', ['or', ['payment_data' => null], ['payment_data' => '']]]]
            ])
            ->one();
//        stopv($request);
        return $this->render('paintingDetails', [
            'model' => $painting,
            'frames' => $frames,
//            'productsDataProvider' => $productsDataProvider,
            'request'=> $request,

        ]);
    }

    public function actionAddFrame($id = 0)
    {

        $product = Product::find()
            ->andWhere(['status' => ActiveInactiveStatus::active])
            ->andWhere(['id' => $id])
            ->one();

        $frames=[];
        $columnp = 0;
        $rowp = 0;
        foreach ($product->productFrames as $oneproductframe ){
//            var_dump('row='.$row);
//            var_dump('col='.$column);
            $frames[$rowp][$columnp] = $oneproductframe;
            $columnp++;
            if($columnp%3 == 0){
                $columnp = 0;
                $rowp++;
            }
        }

        return $this->renderAjax('setFrame', [
            'model' => $product,
            'frames' => $frames,
//            'productsDataProvider' => $productsDataProvider,
//            'type'=> $id,

        ]);
    }



}
