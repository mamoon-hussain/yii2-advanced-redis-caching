<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\enums\ActiveInactiveStatus;
use common\enums\PaintingToolType;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

setViewParam('liActive', 'product');

switch ($type) {
    case PaintingToolType::painting:
        setViewParam('liinActive', 'painting');
        $visiblep = true;
        $visiblet = false;
        break;

    case PaintingToolType::tool:
        setViewParam('liinActive', 'tool');
        $visiblep = false;
        $visiblet = true;
        break;
}
?>


<div class="product-view">
    <div class="panel panel-default">
        <div class="panel-body">
    <p>
        <?= Html::a(t('Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(t('Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => t('Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            [
                'attribute' => 'category_id',
                'value' => function($model){
                    return $model->category->name;
                },
                'format' => 'raw',
                'visible' => $visiblet,
            ],
            'price',
            [
                'attribute' => 'has_offer',
                'value' => function($model){
                    return $model->has_offer ? t('Yes') : t('No');
                },
                'format' => 'raw',
                'visible' => $visiblet,
            ],
            [
                'attribute' => 'old_price',
                'value' => function($model){
                    return $model->old_price;
                },
                'format' => 'raw',
                'visible' => $visiblet && $model->has_offer,
            ],
            [
                'attribute' => 'type',
                'value' => function($model){
                    return PaintingToolType::LabelOfStyle($model->type);
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'category_id',
                'value' => function($model){
                    return $model->category->name;
                },
                'format' => 'raw',
                'visible' => $visiblet,
            ],
            'description:ntext',
            [
                'attribute' => 'small_description',
                'value' => function($model){
                    return $model->small_description;
                },
                'format' => 'raw',
                'visible' => $visiblep,
            ],
            'create_date',
            [
                'attribute' => 'status',
                'value' => function($model){
                    return ActiveInactiveStatus::LabelOfStyle($model->status);
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'image',
                'value' => function($model){
                    return '<img class="img_view" src="'.$model->imageUrl.'">';
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'video',
                'value' => function($model){
        if($model->video){
            return '<video class="img_view" src="'.$model->videoUrl.'"></video>';
        } else {
            return $model->video;
        }

                },
                'format' => 'raw',
                'visible' => $visiblep,
            ],
        ],
    ]) ?>

    <?php if($visiblep == true) {?>
        <div class="panel panel-default">
            <div class="panel-body">
                <h3><?= t('Frames')?></h3>

                <?= GridView::widget([
                    'dataProvider' => $imagesDp,
                    'filterModel' => $imagesSm,
                    'columns' =>
                        [

                            ['class' => 'yii\grid\SerialColumn', 'options'=>['style'=>'width:10%'] ],

                            [
                                'attribute' =>'image',
                                'label' => t('Frames'),
                                'value' => function($model){
                                    return '<img class="img_view" src="'.$model->imageUrl.'" style="max-height: 100px; max-width: 100px;">';
                                },
                                'format' => 'raw',
                                'filter' =>false,

                            ],
                            [
                                'label' => '',
                                'options'=>['style'=>'width:10%'],
                                'value' => function($model){
                                    $btn = Html::button(t('Delete'), [
                                        'class' => 'activity-view-link btn btn-sm btn-danger',
                                        'data-toggle' => 'modal',
                                        'data-target' => '#myModal',
                                        'value' => Yii::$app->urlManager->createUrl("/product/delete-image?id=$model->id")]);
                                    return $btn;
                                },
                                'format' => 'raw',
                                'filter' => false,
                            ],
                        ],
                ]); ?>
            </div>
        </div>
    <?php } ?>
</div>
</div>
</div>
