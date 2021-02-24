<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\enums\ActiveInactiveStatus;
use common\enums\PlaceType;
use common\enums\CourseType;
use common\enums\DayMonthEnums;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\PlaceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = t('Places and Tickets');
$this->params['breadcrumbs'][] = $this->title;
setViewParam('liActive', 'places and tickets');

switch ($type) {
    case PlaceType::course:
        setViewParam('liinActive', 'course');
        $this->title = t('Courses');
        $create = t('Create Course');
        $visiblec= true;
        $visibleh = false;
        $visiblep = false;
        $showCreate = true;
        break;

    case PlaceType::hall:
        setViewParam('liinActive', 'hall');
        $this->title = t('Art Classes');
        $create = t('Create Art Class');
        $visiblec = false;
        $visibleh = true;
        $visiblep = false;
        $showCreate = true;
        break;

    case PlaceType::package:
        setViewParam('liinActive', 'package');
        $this->title = t('Art Tables');
        $create = t('Create Art Table');
        $visiblec = false;
        $visibleh = false;
        $visiblep = true;
        $showCreate = false;
        break;
} ?>


<div class="place-index">
    <div class="panel panel-default">
        <div class="panel-body">
            <?php if($showCreate){ ?>
                <p>
                    <?= Html::a($create, [t('create'), 't' => $type], ['class' => 'btn btn-success']) ?>
                </p>
            <?php } ?>


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
                        'visible'  => $visiblep,
                    ],
                    'name',
                    [
                        'attribute' =>'course_type',
                        'value'  => function($model){
                            return CourseType::LabelOfStyle($model->course_type);
                        },
                        'format' => 'raw',
                        'filter' => Html::activeDropDownList($searchModel,'course_type',CourseType::Labels(),
                            [
                                'class' =>'form-control',
                                'prompt' =>t('Type')
                            ]),
                        'visible'  => $visiblec,
                    ],

                    [
                        'attribute' =>'price',
                        'visible'  => $visiblec || $visiblep,
                    ],
                    [
                        'attribute' =>'capacity',
                        'visible'  => $visibleh,

                    ],
//                    [
//                        'attribute' =>'oneday_price',
//                        'visible'  => $visibleh,
//
//                    ],
                    [
                        'attribute' =>'seats_number',
                        'visible'  => $visiblec,

                    ],
//                    [
//                        'attribute' =>'description',
//                        'visible'  => $visiblec || $visiblep || $visibleh,
//
//                    ],
//                    [
//                        'attribute' =>'price_unit',
//                        'value'  => function($model){
//                            return DayMonthEnums::LabelOfStyle($model->price_unit);
//
//                        },
//                        'format' => 'raw',
//                        'filter' => Html::activeDropDownList($searchModel,'status',DayMonthEnums::Labels(),
//                            [
//                                'class' =>'form-control',
//                                'prompt' =>t('Price Unit')
//                            ]),
//                        'visible'  => $visiblep,
//                    ],
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
                                    'value' => Yii::$app->urlManager->createUrl("/place/change-status?id=$model->id&s=" . ActiveInactiveStatus::inactive)]);
                            } else {
                                $btn = Html::button(t('Activate'), [
                                    'style' => 'color: white;',
                                    'class' => 'activity-view-link btn btn-sm btn-success',
                                    'data-toggle' => 'modal',
                                    'data-target' => '#myModal',
                                    'value' => Yii::$app->urlManager->createUrl("/place/change-status?id=$model->id&s=" . ActiveInactiveStatus::active)]);
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
                                        'value' => Yii::$app->urlManager->createUrl("/place/localization?id=$model->id")]);
                                return $btns;
                            },
                        ],
                    ],

                ],
            ]); ?>

        </div>
    </div>
</div>
