<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\enums\ActiveInactiveStatus;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = t('Categories');
$this->params['breadcrumbs'][] = $this->title;
setViewParam('liActive', 'category');
?>

<div class="category-index">
    <div class="panel panel-default">
        <div class="panel-body">


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
                        'attribute' =>'image',
                        'value' => function($model){
                            return '<img class="img-sm" src="'.$model->imageUrl.'" >';
                        },
                        'format' => 'raw',
                        'filter' =>false,
                    ],
                    'name',
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
                                    'value' => Yii::$app->urlManager->createUrl("/category/change-status?id=$model->id&s=" . ActiveInactiveStatus::inactive)]);
                            } else {
                                $btn = Html::button(t('Activate'), [
                                    'style' => 'color: white;',
                                    'class' => 'activity-view-link btn btn-sm btn-success',
                                    'data-toggle' => 'modal',
                                    'data-target' => '#myModal',
                                    'value' => Yii::$app->urlManager->createUrl("/category/change-status?id=$model->id&s=" . ActiveInactiveStatus::active)]);
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
                                        'value' => Yii::$app->urlManager->createUrl("/category/localization?id=$model->id")]);
                                return $btns;
                            },
                        ],
                    ],
                ],
            ]); ?>


        </div>
    </div>
</div>
