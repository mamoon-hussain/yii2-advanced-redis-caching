<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\generated\search\ContactUsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = t('Contact Us Requests');
$this->params['breadcrumbs'][] = $this->title;
setViewParam('liActive', 'contact-us');
?>
<div class="contact-us-index">
    <div class="panel panel-default">
        <div class="panel-body">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'phone',
            [
                'attribute' =>'create_date',
                'value'  => function($model){
                    return date(\common\enums\Constents::date_format_view_3, strtotime($model->create_date));

                },
                'format' => 'raw',
            ],
            [
                'attribute' =>'status',
                'value'  => function($model){
                    return \common\enums\ContactUsStatus::LabelOfStyle($model->status);

                },
                'format' => 'raw',
                'filter' => Html::activeDropDownList($searchModel,'status', \common\enums\ContactUsStatus::Labels(),
                    [
                        'class' =>'form-control',
                        'prompt' =>t('Status')
                    ]),
            ],
            [
                'label' => '',
                'value' => function($model){
                    $btn = '';
                    if($model->status == \common\enums\ContactUsStatus::new_request){
                        $btn = Html::button(t('Change Status'), [
                            'style' => 'color: white;',
                            'class' => 'activity-view-link btn btn-sm btn-warning',
                            'data-toggle' => 'modal',
                            'data-target' => '#myModal',
                            'value' => Yii::$app->urlManager->createUrl("/contact-us/change-status?id=$model->id")]);
                    }

                    return $btn;
                },
                'format' => 'raw',
                'filter' => false,
            ],
            //'create_date',

            ['class' => 'common\utils\ActionColumn',
                'template' => '{delete}',
            ],
        ],
    ]); ?>


</div>
</div>
</div>
