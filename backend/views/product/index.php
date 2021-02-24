<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\enums\PaintingToolType;
use common\enums\ActiveInactiveStatus;
use yii\helpers\ArrayHelper;
use common\models\Product;
use common\models\Category;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->params['breadcrumbs'][] = $this->title;
setViewParam('liActive', 'product');
switch ($type) {
    case PaintingToolType::painting:
        setViewParam('liinActive', 'painting');
        $this->title = t('Paintings');
        $create = t('Create Painting');
        $visiblep = true;
        $visiblet = false;
        break;

    case PaintingToolType::tool:
        setViewParam('liinActive', 'tool');
        $this->title = t('Tools');
        $create = t('Create Tool');
        $visiblep = false;
        $visiblet = true;
        break;
} ?>


<div class="product-index">
    <div class="panel panel-default">
        <div class="panel-body">
    <p>
        <?= Html::a($create, [t('create'), 't' => $type], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'attribute' =>'image',
                        'value' => function($model){
                            return '<img class="img-sm" src="'.$model->imageUrl.'" >';
                        },
                        'format' => 'raw',
                        'filter' =>false,
                    ],
                    'name',
                    [
                        'attribute' => 'category_id',
                        'value' => function($model){
                            return $model->category->name;
                        },
                        'filter' => Html::activeDropDownList($searchModel,'category_id',ArrayHelper::map(
                            Category::find()
                                ->andWhere(['status'=>ActiveInactiveStatus::active])->all(),'id','name'),
                            ['class' =>'form-control','prompt' =>t('Select...')]),
                        'visible' => $visiblet,
                    ],
                    'price',
                    [
                        'attribute' => 'small_description',
                        'value' => 'small_description',
                        'visible' => $visiblep,
                    ],
//                    'description',
                    //'frame',
                    //'create_date',
                    [
                        'attribute' =>'status',
                        'value'  => function($model){
                            return ActiveInactiveStatus::LabelOfStyle($model->status);

                        },
                        'format' => 'raw',
                        'filter' => Html::activeDropDownList($searchModel,'status',ActiveInactiveStatus::Labels(),
                            [
                                'class' =>'form-control',
                                'prompt' =>t('Status')
                            ]),
                    ],
                    [
                        'label' => '',
                        'value' => function($model){
                            $btn = '';
                            if($model->status == ActiveInactiveStatus::active){
                                $btn = Html::button(t('Deactivate'), [
                                    'style' => 'color: white;',
                                    'class' => 'activity-view-link btn btn-sm btn-warning',
                                    'data-toggle' => 'modal',
                                    'data-target' => '#myModal',
                                    'value' => Yii::$app->urlManager->createUrl("/product/change-status?id=$model->id&s=" . ActiveInactiveStatus::inactive)]);
                            } else {
                                $btn = Html::button(t('Activate'), [
                                    'style' => 'color: white;',
                                    'class' => 'activity-view-link btn btn-sm btn-success',
                                    'data-toggle' => 'modal',
                                    'data-target' => '#myModal',
                                    'value' => Yii::$app->urlManager->createUrl("/product/change-status?id=$model->id&s=" . ActiveInactiveStatus::active)]);
                            }
                            return $btn;
                        },
                        'format' => 'raw',
                        'filter' => false,
                    ],
                    [
                        'class' => 'common\utils\ActionColumn',
                        'headerOptions' => ['style' => 'width: 10%'],
                        'template' => '{view}{update}{translate}',
                        'buttons'=>[
                            'translate'=>function ($url, $model) {
                                $btns = '';
                                $btns = $btns . ' ' . Html::button('<span class="fa fa-language" style="margin: 0 10%; cursor: pointer;"></span>', [
                                        'class' => 'activity-view-link',
                                        'style' => 'border: none;background: transparent;color: #2782df;',
                                        'data-toggle' => 'modal',
                                        'data-target' => '#myModal',
                                        'value' => Yii::$app->urlManager->createUrl("/product/localization?id=$model->id")]);
                                return $btns;
                            },
                        ],
                    ],
                ],
            ]); ?>


        </div>
    </div>
</div>

