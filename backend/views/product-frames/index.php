<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Product;
use common\enums\ActiveInactiveStatus;
use common\models\Admin;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ProductFramesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = t('Frames');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-frames-index">


    <p>
        <?= Html::a(t('Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'product_id',
            [
                'attribute' =>'product_id',
                'value'  => 'product.name',
                'filter' => Html::activeDropDownList($searchModel,'product_id',ArrayHelper::map(
                    Product::find()
                        ->andWhere(['status' =>ActiveInactiveStatus::active])
                        ->all(),'id','name'),
                    ['class' =>'form-control','prompt' =>t('Select')]),
                //'format' => 'raw',
            ],
            [
                'attribute' =>'image',
                'value' => function($model){
                    return '<img class="img-sm" src="'.$model->imageUrl.'" >';
                },
                'format' => 'raw',
                'filter' =>false,
            ],

            ['class' => 'common\utils\ActionColumn'],
        ],
    ]); ?>


</div>
