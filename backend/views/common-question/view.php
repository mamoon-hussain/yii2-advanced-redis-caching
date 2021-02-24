<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\enums\ActiveInactiveStatus;

/* @var $this yii\web\View */
/* @var $model common\models\CommonQuestion */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Common Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
setViewParam('liActive', 'common-question');
?>
<div class="common-question-view">
    <div class="panel panel-default">
        <div class="panel-body">
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
                    'question:ntext',
                    'answer:ntext',
                    'create_date',
                    [
                        'attribute' => 'status',
                        'value' => function($model){
                            return ActiveInactiveStatus::LabelOfStyle($model->status);
                        },
                        'format' => 'raw',
                    ],
                ],
            ]) ?>

        </div>
    </div>
</div>
