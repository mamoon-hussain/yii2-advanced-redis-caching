<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\enums\ActiveInactiveStatus;

/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
setViewParam('liActive', 'category');
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
                        'attribute' => 'status',
                        'value' => function($model){
                            return ActiveInactiveStatus::LabelOfStyle($model->status);
                        },
                        'format' => 'raw',
                    ],
                    'created_date',
                    [
                        'attribute' => 'image',
                        'value' => function($model){
                            return '<img class="img_view" src="'.$model->imageUrl.'">';
                        },
                        'format' => 'raw',
                    ],
                ],
            ]) ?>

        </div>
    </div>
</div>
