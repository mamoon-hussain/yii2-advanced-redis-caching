<?php

use common\enums\RequestStatus;
use common\models\Request;
use yii\widgets\Pjax;
use yii\widgets\ListView;
use site\productsList;

/* @var $this yii\web\View */
setViewParam('liActive', 'home');
$this->title = t('Art Works');
?>


<section class="header3 cid-si3MqNY046 mbr-fullscreen" id="header3-j" style="background-image: url(<?= imageUrl('mbr-2-1920x1280.jpg') ?>);">
    <div class="mbr-overlay" style="opacity: 0.7; background-color: rgb(53, 53, 53);"></div>
    <div class="align-center container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <h1 class="mbr-section-title mbr-fonts-style mb-3 display-2">
                    <strong>
                        <?=t('Contemporary painting for Sale')?>
                    </strong>
                </h1>
            </div>
        </div>
    </div>
</section>




<section class="features3 cid-si3AOTwsav" id="features3-g" style="padding-top: 1%;">
    <div class="container">
        <div class="row mt-4">
            <?php
            foreach ($paintingsDataProvider->getModels() as $model){
                $request = Request::find()
                    ->andWhere(['product_id' => $model->id])
                    ->andWhere(['or',
                        ['in', 'status', [RequestStatus::under_process, RequestStatus::done]],
                        ['payment_result' => 'CAPTURED']
//                ['and', ['payment_method' => PaymentMethod::paypal], ['not', ['or', ['payment_data' => null], ['payment_data' => '']]]]
                    ])
                    ->one();
                ?>
                <div class="item features-image сol-12 col-md-6 col-lg-4">
                    <a href="<?= Yii::$app->urlManager->createUrl("/paintings/details?id=".$model->id) ?>">
                        <div class="item-img" style="position: relative;">
                            <img src="<?= $model->imageUrl ?>" alt="">
                            <?php if($request){ ?>
                                <span style="position: absolute;
                                    top: 3%;
                                    right: 2%;
                                    color: white;
                                    font-size: 12px;
                                    background-color: #ff7600;
                                    border-radius: 20px;
                                    padding: 2%;">
                                    <?= t('Sold Out') ?>
                                </span>
                            <?php } ?>
                            <h5 class="item-title mbr-fonts-style display-7 text-right align-text-top"
                                style="background-color: rgba(0,0,0,0.5); position: absolute; width: 50%; right: 0%; bottom: 0%; color: white; margin-bottom: 0%; line-height: 50px; padding-right: 4%;">
                                <strong><?= $model->price . t('KD') ?></strong>
                            </h5>
                            <h6 class="item-subtitle mbr-fonts-style mt-1 display-7 text-left" style="background-color: rgba(0,0,0,0.5); position: absolute; width: 50%; bottom: 0%; color: white; margin-bottom: 25px;
                            line-height: 25px; padding-left: 4%; font-weight: 600;">
                                <em><?= $model->name ?></em>
                            </h6>
                            <h6 class="item-subtitle mbr-fonts-style mt-1 display-7 text-left" style="background-color: rgba(0,0,0,0.5); position: absolute; width: 50%; bottom: 0%; color: white; margin-bottom: 0px;
                            line-height: 25px; padding-left: 4%;">
                                <em><?= $model->small_description ?></em>
                            </h6>
                        </div>
                    </a>
                </div>
            <?php } ?>

        </div>
    </div>
</section>












<!--<section class="features3 cid-si3AOTwsav" id="features3-g">-->
<!--    <div class="container">-->
<!--        <div class="row mt-4">-->
<!--            --><?php
//            Pjax::begin();
//
//            echo ListView::widget([
//                'dataProvider' => $paintingsDataProvider,
//                'itemView' =>'paintingslist',
//                'summary' => '',
//
//                'id'           => false,
//                'options'      => [
//                    'tag' => false,
//                ],
//                'itemOptions'  => [
//                    'tag' => false,
//                ],
//
//            ]);
//            Pjax::end(); ?>
<!---->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->

