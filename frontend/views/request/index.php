<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\enums\RequestEnums;
use common\models\User;
use yii\helpers\ArrayHelper;
use common\enums\RequestStatus;
use common\enums\RequestTypes;
use common\enums\PaymentMethod;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\RequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = t('My Requests');
?>

    <section class="header10 cid-si3gh69yvp mbr-fullscreen" id="header10-7" style="background-image: url('<?= imageUrl('/mbr-1920x1281.jpg') ?>');">
        <div class="align-center container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-9">
                    <h1 class="mbr-section-title mbr-fonts-style mb-3 display-1"><strong><?= $this->title ?></strong></h1>
                </div>
            </div>
        </div>
    </section>

    <div class="" style="padding: 0 5%;margin-top:50px">
        <div class="mx-auto " style="     margin-bottom: 25px">

            <div class="container" >
                <div class="row" style="overflow: scroll;overflow-y: hidden;">
                    <div class="col-12 col-md-12 align-center col-lg-12" style="">
                        <?php if (Yii::$app->session->hasFlash('flash_error')): ?>
                            <div class="alert alert-danger" role="alert">
                                <?= Yii::$app->session->getFlash('flash_error'); ?>
                            </div>
                        <?php endif; ?>
                        <?php if (Yii::$app->session->hasFlash('flash_success')): ?>
                            <div class="alert alert-success" role="alert">
                                <?= Yii::$app->session->getFlash('flash_success'); ?>
                            </div>
                        <?php endif; ?>
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
//                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
//                                [
//                                    'attribute' =>'item_name',
//                                    'value'  => function($model){
//                                        return $model->item_name;
//
//                                    },
//                                    'format' => 'raw',
//                                ],
//                                [
//                                    'attribute' =>'created_date',
//                                    'value'  => function($model){
//                                        return date(\common\enums\Constents::date_format_view_3, strtotime($model->created_date));
//
//                                    },
//                                    'format' => 'raw',
//                                ],
                                [
                                    'attribute' =>'enums',
                                    'value'  => function($model){
                                        return RequestEnums::LabelOfStyle($model->enums);

                                    },
                                    'format' => 'raw',
                                    'filter' => Html::activeDropDownList($searchModel,'enums', RequestEnums::Labels(),
                                        [
                                            'class' =>'form-control',
                                            'prompt' =>t('Select...')
                                        ]),
                                ],
//                                [
//                                    'attribute' =>'payment_method',
//                                    'value'  => function($model){
//                                        $res = PaymentMethod::LabelOfStyle($model->payment_method);
//                                        if($model->payment_method == PaymentMethod::paypal) {
//                                            if ($model->isPayed) {
//                                                $res = $res . '<br/><span class=" badge badge-sm" style="margin-top: 3px;color: white; font-size: 17px;background-color: #53ff43">' .t('Payed').'</span>';
//                                            } else {
//                                                $res = $res . '<br/><span class=" badge badge-sm" style="margin-top: 3px;color: white; font-size: 17px;background-color: #ff1100">' .t('Not Payed').'</span>';
//                                            }
//                                        }
//                                        return $res;
//
//                                    },
//                                    'format' => 'raw',
//                                    'filter' => Html::activeDropDownList($searchModel,'payment_method', PaymentMethod::Labels(),
//                                        [
//                                            'class' =>'form-control',
//                                            'prompt' =>t('Select...')
//                                        ]),
//                                ],
                                [
                                    'attribute' =>'status',
                                    'value'  => function($model){
                                        return RequestStatus::LabelOfStyle($model->status);

                                    },
                                    'format' => 'raw',
                                    'filter' => Html::activeDropDownList($searchModel,'status', RequestStatus::Labels(),
                                        [
                                            'class' =>'form-control',
                                            'prompt' =>t('Select...')
                                        ]),
                                ],
                                [
                                    'label' => '',
                                    'value' => function($model){
                                        $btn = '';
                                        $btn = Html::button('<i class="fa fa-eye"></i>', [
                                            'style' => 'color: white;',
                                            'class' => 'request-status btn btn-sm btn-warning',
                                            'data-toggle' => 'modal',
                                            'data-target' => '#myModal',
                                            'value' => Yii::$app->urlManager->createUrl("/request/view?id=$model->id")]);

                                        return $btn;
                                    },
                                    'format' => 'raw',
                                    'filter' => false,
                                ],
                            ],
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .table-bordered td, .table-bordered th {
            border: 1px solid #dee2e6;
            color: black;
        }
        .table>:not(caption)>*>* {
            padding: .5rem .5rem;
            background-color: #ffffff;
            background-image: linear-gradient(var(--bs-table-accent-bg),var(--bs-table-accent-bg));
            border-bottom-width: 1px;
        }
    </style>



