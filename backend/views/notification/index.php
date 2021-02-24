<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\enums\SentNotsentStatus;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\NotificationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = t('Notifications');
$this->params['breadcrumbs'][] = $this->title;
setViewParam('liActive', 'notification');
setViewParam('liinActive', 'notification');
?>

<div class="panel panel-default">
    <div class="panel-body">
        <div class="notification-index">

            <p>
                <?= Html::a(t('Create'), ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'attribute' =>'title',
                        'value' => function($model){
                            return '<a href="'.Yii::$app->urlManager->createUrl("/request/view?id=$model->data_id").'">'
                                .t($model->title)
                                .'</a>';
                        },
                        'format' => 'raw'
                    ],
                    [
                        'attribute' =>'body',
                        'value' => function($model){
                            return $model->body;
                        },
                        'format' => 'raw'
                    ],
                    [
                        'class' => 'common\utils\ActionColumn',
                        'template' => '{delete}',
                        'buttons'=>[
                            'delete' => function ($url, $model) {
                                return '<a href="'.Yii::$app->urlManager->createUrl("/notification/delete?id=$model->id").'" data-pjax="0" data-confirm="'.t('Are You Sure?').'" data-method="post">
                                                <span class="fa fa-trash" style="    margin: 0 2%"></span>
                                            </a>';
                            }
                        ]
                    ],
                ],
            ]);
            ?>


        </div>
    </div>
</div>
