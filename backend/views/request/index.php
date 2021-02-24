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

$this->title = t('Requests');
$this->params['breadcrumbs'][] = $this->title;
setViewParam('liActive', 'request');
?>
<div class="request-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
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
        'filterModel' => $searchModel,
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
                'filter' => Html::activeDropDownList($searchModel,'enums', RequestEnums::Labels(),
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
                'filter' => Html::activeDropDownList($searchModel,'user_id', ArrayHelper::map(
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
                'filter' => Html::activeDropDownList($searchModel,'payment_method', PaymentMethod::Labels(),
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
                'filter' => Html::activeDropDownList($searchModel,'status', RequestStatus::Labels(),
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
                            'class' => 'request-status btn btn-sm btn-warning',
                            'data-toggle' => 'modal',
                            'data-target' => '#myModal',
                            'value' => Yii::$app->urlManager->createUrl("/request/change-request-status?id=$model->id")]);
                    }

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

            ['class' => 'common\utils\ActionColumn',
                'template' => '{view}',
            ],
        ],
    ]); ?>
</div>

<?php $this->registerJsFile('@web/js/custom/request_status.js', ['depends' => [yii\web\JqueryAsset::className()]]); ?>