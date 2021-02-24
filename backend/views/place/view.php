<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\enums\PlaceType;
use common\enums\ActiveInactiveStatus;
use common\enums\CourseType;
use yii\widgets\Pjax;
use yii\grid\GridView;
use common\enums\DayMonthEnums;
use common\enums\RequestEnums;
use yii\helpers\ArrayHelper;
use common\models\User;
use common\enums\PaymentMethod;
use common\enums\RequestStatus;

/* @var $this yii\web\View */
/* @var $model common\models\Place */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Places', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

setViewParam('liActive', 'places and tickets');

switch ($model->type) {
    case PlaceType::course:
        setViewParam('liinActive', 'course');
        $visiblec= true;
        $visibleh = false;
        $visiblep = false;
        $content = t('Course Contents');
        break;

    case PlaceType::hall:
        setViewParam('liinActive', 'hall');
        $visiblec = false;
        $visibleh = true;
        $visiblep = false;
        $content = t('');
        break;

    case PlaceType::package:
        setViewParam('liinActive', 'package');
        $visiblec = false;
        $visibleh = false;
        $visiblep = true;
        $content = t('Contents');
        break;
}
?>

<div class="place-view">
    <div class="panel panel-default">
        <div class="panel-body">

            <ul class="nav nav-justified nav-tabs nav-tabs-material" id="justifiedTab" role="tablist">
                <li class="nav-item">
                    <a aria-controls="details" aria-selected="true"
                       class="nav-link waves-effect waves-dark active"
                       data-toggle="tab" href="#details" id="details-tab" role="tab">
                        <?= t('Details') ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a aria-controls="requests" aria-selected="true" class="nav-link waves-effect waves-dark "
                       data-toggle="tab" href="#requests" id="requests-tab" role="tab">
                        <?= t('Requests') ?>
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="justifiedTabContent">
                <div aria-labelledby="details-tab" class="tab-pane fade active show" id="details" role="tabpanel">
                    <p>
                        <?= Html::a(t('Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                        <?php
//                        Html::a(t('Delete'), ['delete', 'id' => $model->id], [
//                            'class' => 'btn btn-danger',
//                            'data' => [
//                                'confirm' => 'Are you sure you want to delete this item?',
//                                'method' => 'post',
//                            ],
//                        ]) ?>
                    </p>

                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'name',
                            [
                                'attribute' => 'course_type',
                                'value' => function($model){
                                    return CourseType::LabelOfStyle($model->course_type);
                                },
                                'format' => 'raw',
                                'visible'  => $visiblec,
                            ],
                            [
                                'attribute' => 'price',
                                'visible'  => $visiblec || $visiblep,
                            ],
                            [
                                'attribute' => 'price',
                                'label' => t('Price (Noon Period)'),
                                'visible'  => $visibleh,
                            ],
                            [
                                'attribute' => 'price_2',
                                'label' => t('Price (Afternoon Period)'),
                                'visible'  => $visibleh,
                            ],
                            [
                                'attribute' => 'price_unit',
                                'value' => function($model){
                                    return DayMonthEnums::LabelOfStyle($model->price_unit);
                                },
                                'format' => 'raw',
                                'visible'  => $visiblep,
                            ],
                            [
                                'attribute' => 'capacity',
                                'visible'  => $visibleh,
                            ],
//                            [
//                                'attribute' => 'oneday_price',
//                                'visible'  => $visibleh,
//                            ],
            [
                'attribute' => 'small_description',
                'visible'  => $visibleh,
            ],
                            [
                'attribute' => 'description',
                'visible'  => $visibleh,
            ],
//                            [
//                                'attribute' => 'start_date',
//                                'visible'  => $visiblec || $visiblep,
//                            ],
//                            [
//                                'attribute' => 'end_date',
//                                'visible'  => $visiblec,
//                            ],
//                            'create_date',
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
//                                'visible'  => $visiblep || $visiblec,
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
                                'visible' => $visiblec || $visibleh,
                            ],
                        ],
                    ]) ?>

                    <?php if($visiblec == true || $visiblep== true) { ?>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h3><?= $content ?></h3>
                                <?php Pjax::begin();
                                echo GridView::widget([
                                    'dataProvider' => $contentDp,
                                    'filterModel' => $contentSm,
                                    'columns' =>
                                        [

                                            ['class' => 'yii\grid\SerialColumn', 'options'=>['style'=>'width:10%'] ],

                                            [
                                                'attribute' =>'content',
                                                'label' => t('Content'),
                                                'value' => function($model){
                                                    return $model->content;
                                                },
                                            ],
                                            [
                                                'label' => '',
                                                'options'=>['style'=>'width:10%'],
                                                'value' => function($model){
                                                    $btn = Html::button(t('Delete'), [
                                                        'class' => 'activity-view-link btn btn-sm btn-danger',
                                                        'data-toggle' => 'modal',
                                                        'data-target' => '#myModal',
                                                        'value' => Yii::$app->urlManager->createUrl("/place/delete-content?id=$model->id&s=")]);
                                                    return $btn;
                                                },
                                                'format' => 'raw',
                                                'filter' => false,
                                            ],
                                        ],
                                ]);
                                Pjax::end(); ?>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if($visiblec == true || $visibleh== true) {?>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h3><?= t('Images')?></h3>

                                <?= GridView::widget([
                                    'dataProvider' => $imagesDp,
                                    'filterModel' => $imagesSm,
                                    'columns' =>
                                        [

                                            ['class' => 'yii\grid\SerialColumn', 'options'=>['style'=>'width:10%'] ],

                                            [
                                                'attribute' =>'image',
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
                                                        'value' => Yii::$app->urlManager->createUrl("/place/delete-image?id=$model->id")]);
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
                <div aria-labelledby="requests-tab" class="tab-pane fade" id="requests" role="tabpanel">
                    <?= GridView::widget([
                        'dataProvider' => $requestDataProvider,
                        'filterModel' => $requestSearchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                                'attribute' =>'item_name',
                                'value'  => function($model){
                                    return $model->item_name;

                                },
                                'format' => 'raw',
                            ],
                            [
                                'attribute' =>'created_date',
                                'value'  => function($model){
                                    return date(\common\enums\Constents::date_format_view_3, strtotime($model->created_date));

                                },
                                'format' => 'raw',
                            ],
                            [
                                'attribute' =>'enums',
                                'value'  => function($model){
                                    return RequestEnums::LabelOfStyle($model->enums);

                                },
                                'format' => 'raw',
                                'filter' => Html::activeDropDownList($requestSearchModel,'enums', RequestEnums::Labels(),
                                    [
                                        'class' =>'form-control',
                                        'prompt' =>t('Enums')
                                    ]),
                            ],

                            [
                                'attribute' =>'user_id',
                                'value'  => function($model){
                                    return $model->user->username;
                                },
                                'filter' => Html::activeDropDownList($requestSearchModel,'user_id', ArrayHelper::map(
                                    User::find()
                                        ->all(),'id','username'),
                                    ['class' =>'form-control','prompt' =>t('Select...')]),
                            ],
                            'fname',
                            'lname',
                            'phone',
                            'email',
//            'product_id',
//            'place_id',
                            [
                                'attribute' =>'payment_method',
                                'value'  => function($model){
                                    $res = PaymentMethod::LabelOfStyle($model->payment_method);
                                    if($model->payment_method == PaymentMethod::paypal) {
                                        if ($model->isPayed) {
                                            $res = $res . '<br/><span class=" badge badge-sm" style="margin-top: 3px;color: white; font-size: 17px;background-color: #53ff43">' .t('Payed').'</span>';
                                        } else {
                                            $res = $res . '<br/><span class=" badge badge-sm" style="margin-top: 3px;color: white; font-size: 17px;background-color: #ff1100">' .t('Not Payed').'</span>';
                                        }
                                    }
                                    return $res;

                                },
                                'format' => 'raw',
                                'filter' => Html::activeDropDownList($requestSearchModel,'payment_method', PaymentMethod::Labels(),
                                    [
                                        'class' =>'form-control',
                                        'prompt' =>t('Select...')
                                    ]),
                            ],
                            [
                                'attribute' =>'status',
                                'value'  => function($model){
                                    return RequestStatus::LabelOfStyle($model->status);

                                },
                                'format' => 'raw',
                                'filter' => Html::activeDropDownList($requestSearchModel,'status', RequestStatus::Labels(),
                                    [
                                        'class' =>'form-control',
                                        'prompt' =>t('Status')
                                    ]),
                            ],
                            [
                                'label' => '',
                                'value' => function($model){
                                    $btn = '';
                                    if((($model->payment_method == PaymentMethod::cash) || ($model->isPayed))
                                        && ($model->status == RequestStatus::new_request || $model->status == RequestStatus::under_process)){
                                        $btn = Html::button(t('Change Status'), [
                                            'style' => 'color: white;',
                                            'class' => 'activity-view-link btn btn-sm btn-warning',
                                            'data-toggle' => 'modal',
                                            'data-target' => '#myModal',
                                            'value' => Yii::$app->urlManager->createUrl("/request/change-request-status?id=$model->id")]);

                                    }
                                    $btn = $btn. ' '.Html::button(t('Details'), [
                                            'style' => 'color: white;',
                                            'class' => 'activity-view-link btn btn-sm btn-primary',
                                            'data-toggle' => 'modal',
                                            'data-target' => '#myModal',
                                            'value' => Yii::$app->urlManager->createUrl("/request/view-modal?id=$model->id")]);

                                    return $btn;
                                },
                                'format' => 'raw',
                                'filter' => false,
                            ],

                            //'created_date',
                            //'fname',
                            //'lname',
                            //'phone',
                            //'email:email',
                        ],
                    ]); ?>
                </div>
            </div>

















</div>
</div>
</div>


