<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\enums\OrderStatus;
use yii\widgets\Pjax;
use common\enums\Constents;
use common\enums\PaymentMethod;
use common\services\OrderService;

/* @var $this yii\web\View */
/* @var $searchModel common\models\generated\search\UserOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = t('Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php  echo $this->render('_shared_head'); ?>

<section class="ftco-section ftco-no-pt------- bg-light">
    <div class="container">
        <div class="row d-flex no-gutters">
            <div class="col-md-3 pl-md-5 py-md-5" style="padding-top: 0 !important;">
                <?php  echo $this->render('_shared_menu', [
                    'active' => 'profile'
                ]); ?>
            </div>
            <div class="col-md-9 d-flex">
                <div style="width: 100%;">
                    <?php
                    Pjax::begin()
                    ?>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            [
                                'attribute' => 'create_date',
                                'value' => function($model) {
                                    $text = date(Constents::date_format_view_2, strtotime($model->create_date));
                                    return $text;
                                },
                                'format' => 'raw',
                            ],
                            [
                                'attribute' => 'payment_method',
                                'value' => function($model) {
                                    $text = PaymentMethod::LabelOfStyle($model->payment_method);
                                    return $text;
                                },
                                'format' => 'raw',
                                'filter' => Html::activeDropDownList($searchModel, 'payment_method', PaymentMethod::Labels(), ['class' => 'form-control', 'prompt' => \Yii::t('all', 'Select...')]),
                            ],
                            [
                                'attribute' => 'status',
                                'value' => function($model) {
                                    $text = OrderStatus::LabelOfStyle($model->status);
                                    return $text;
                                },
                                'format' => 'raw',
                                'filter' => Html::activeDropDownList($searchModel, 'status', OrderStatus::Labels(), ['class' => 'form-control', 'prompt' => \Yii::t('all', 'Select...')]),
                            ],
                            [
                                'class' => 'common\utils\ActionColumn',
                                'headerOptions' => ['style' => 'width: 10%'],
                                'template' => '{view}',
                                'buttons' => [
                                    'view' => function ($url, $model) {
                                        $btns = '';
                                        $btns = $btns . '<a class="activity-view-link" href="" data-toggle="modal" data-target="#myModal" style="margin:5px;"
                                         value="' . Yii::$app->urlManager->createUrl("/user/profile/order-details?id=" .  urlencode(OrderService::encrypt($model->id))) . '">'
                                            . '<i class="fa fa-eye"></i>'
                                            . '</a>';
                                        return $btns;
                                    },
                                ],
                            ],
                        ],
                    ]); ?>

                    <?php Pjax::end() ?>
                </div>

            </div>
        </div>
    </div>
</section>

