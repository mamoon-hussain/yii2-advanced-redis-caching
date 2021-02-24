<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ProductFrames */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Product Frames', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-frames-view">

    <p>
        <?= Html::a(t('Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(t('Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'product_id',
                'value' => function($model){
                    return '<img class="img_view" src="'.$model->product->imageUrl.'">';
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'image',
                'label' => t('Frame'),
                'value' => function($model){
                    return '<img class="img_view" src="'.$model->imageUrl.'">';
                },
                'format' => 'raw',
            ],
        ],
    ]) ?>

</div>
