<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\enums\ActiveInactiveStatus;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CommonQuestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = t('Common Questions');
$this->params['breadcrumbs'][] = $this->title;
setViewParam('liActive', 'common-question');
?>
<div class="common-question-index">
    <div class="panel panel-default">
        <div class="panel-body">
            <p>
                <?= Html::a(t('Create Question'), ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'question:ntext',
                    'answer:ntext',
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
                                    'value' => Yii::$app->urlManager->createUrl("/common-question/change-status?id=$model->id&s=" . ActiveInactiveStatus::inactive)]);
                            } else {
                                $btn = Html::button(t('Activate'), [
                                    'style' => 'color: white;',
                                    'class' => 'activity-view-link btn btn-sm btn-success',
                                    'data-toggle' => 'modal',
                                    'data-target' => '#myModal',
                                    'value' => Yii::$app->urlManager->createUrl("/common-question/change-status?id=$model->id&s=" . ActiveInactiveStatus::active)]);
                            }
                            return $btn;
                        },
                        'format' => 'raw',
                        'filter' => false,
                    ],

                    ['class' => 'common\utils\ActionColumn'],

                ],
            ]); ?>


        </div>
    </div>
</div>
