<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\enums\ActiveInactiveStatus;

/** @var yii\web\View $this */
/** @var common\models\search\PostSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
setViewParam('liActive', 'post');
?>
<div class="post-index">

    <p>
        <?= Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'content:ntext',

            [
                'attribute' =>'author_id',
                'value'  => function($model){
                    return $model->author->name;

                },
                'format' => 'raw',
            ],
            [
                'attribute' =>'category_id',
                'value'  => function($model){
                    return $model->category->name;

                },
                'format' => 'raw',
            ],

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
            //'views',
            //'created_at',
            //'updated_at',
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
