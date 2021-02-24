<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\enums\RequestEnums;
use common\enums\RequestStatus;
use common\enums\RequestTypes;
use common\enums\PaymentMethod;

/* @var $this yii\web\View */
/* @var $model common\models\Request */

$this->title = RequestEnums::LabelOf($model->enums);

switch ($type) {
    case RequestTypes::product:
        $visibleProduct = true;
        $visiblePlace = false;
        break;

    case RequestTypes::place:
        $visibleProduct = false;
        $visiblePlace = true;
        break;
    default:
        break;
}
switch ($enums){
    case RequestEnums::painting:
        $name = t('Panting\'s name');
        break;

    case RequestEnums::tool:
        $name = t('Tool\'s name');
        break;
    case RequestEnums::hall:
        $name = t('Hall\'s name');
        break;
    case RequestEnums::package:
        $name = t('Package\'s name');
        break;
    case RequestEnums::course:
        $name = t('Course\'s name');
        break;
    default:
        break;
}
?>
<div class="modal-header">
    <h5 class="modal-title"><?= $this->title ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>

<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'enums',
                        'value' => function($model){
                            return RequestEnums::LabelOfStyle($model->enums);
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'user_id',
                        'value' => $model->user->username,
                    ],
                    'fname',
                    'lname',
                    'phone',
                    [
                        'attribute' => 'email',
                        'value' => '<a href="'.$model->email.'" target="_blank"><i class="fa fa-link"></i></a> <h6>'.$model->email.'</h6>',
                        'format' => 'raw',
                    ],

                    [
                        'attribute' => 'product_id',
                        'label' => $name,
                        'value' => function($model){
                            return $model->product->name;
                        },
                        'format' => 'raw',
                        'visible' => $visibleProduct,
                    ],
                    [
                        'attribute' => 'place_id',
                        'label' => $name,
                        'value' => function($model){
                            return $model->place->name;
                        },
                        'format' => 'raw',
                        'visible' => $visiblePlace,
                    ],
                    [
                        'attribute' => 'price',
                        'value' => function($model){
                            return $model->price.' '.t('KD');;
                        },
                        'format' => 'raw',
//                        'visible' => (($model->enums==RequestEnums::package)),
                    ],
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
                    ],
                    [
                        'attribute' => 'status',
                        'value' => function($model){
                            return RequestStatus::LabelOfStyle($model->status);
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'start_date',
                        'value' => function($model){
                            return date(\common\enums\Constents::date_format_view_3, strtotime($model->start_date));
                        },
                        'format' => 'raw',
//                        'visible' => (($model->enums==RequestEnums::hall) || ($model->enums==RequestEnums::package)),
                        'visible' => (($model->enums==RequestEnums::package)),
                    ],

                    [
                        'attribute' => 'price_unit_number',
                        'value' => function($model){
                            return $model->price_unit_number;
                        },
                        'format' => 'raw',
                        'visible' => (($model->enums==RequestEnums::package)),
                    ],
                    [
                        'attribute' => 'end_date',
                        'value' => function($model){
                            return $model->end_date;
                        },
                        'format' => 'raw',
//                        'visible' => (($model->enums==RequestEnums::hall)),
                        'visible' => false,
                    ],
                    [
                        'attribute' => 'class_period',
                        'value' => function($model){
                            return \common\enums\ClassPeriod::LabelOfStyle($model->class_period);
                        },
                        'format' => 'raw',
//                        'visible' => (($model->enums==RequestEnums::hall)),
                        'visible' => false,
                    ],


                    'created_date',
                    [
                        'attribute' => 'image',
                        'value' => function($model){
                            return '<img class="img_view" src="'.$model->product->imageUrl.'" style="max-height: 200px;">';
                        },
                        'format' => 'raw',
                        'visible' => $visibleProduct,
                    ],

                ],
            ]) ?>
        </div>

        <?php if($model->requestDates){ ?>
            <div class="col-md-12">
                <h4><?= t('Requested Dates') ?></h4>
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th style="text-align: center;border: 2px solid #000000 !important;
                text-transform: uppercase;  text-align: center;
                padding: 4px;"><?= t('Date') ?></th>
                        <th style="text-align: center;border: 2px solid #000000 !important;
                text-transform: uppercase;  text-align: center;
                padding: 4px;"><?= t('Period') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($model->requestDates as $one){ ?>
                        <tr>
                            <td><?= $one->date ?></td>
                            <td><?= \common\enums\ClassPeriod::LabelOfStyle($one->period) ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>

    </div>



</div>





