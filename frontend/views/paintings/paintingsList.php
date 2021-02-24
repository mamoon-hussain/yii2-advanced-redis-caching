<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use backend\assets\DashboardAsset;
use yii\helpers\Html;
use common\widgets\Alert;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
?>



<div class="item features-image сol-12 col-md-6 col-lg-4">
    <div class="item-img" style="position: relative;">
        <a href="<?= Yii::$app->urlManager->createUrl("/paintings/details?id=".$model->id) ?>"><img src="<?= $model->imageUrl ?>" alt=""></a>
        <h5 class="item-title mbr-fonts-style display-7 text-right align-text-top"
            style="background-color: rgba(0,0,0,0.5); position: absolute; width: 50%; right: 0%; bottom: 0%; color: white; margin-bottom: 0%; line-height: 50px; padding-right: 4%;">
            <strong><?= $model->price . t('KD') ?></strong></h5>
        <h6 class="item-subtitle mbr-fonts-style mt-1 display-7 text-left" style="background-color: rgba(0,0,0,0.5); position: absolute; width: 50%; bottom: 0%; color: white; margin-bottom: 25px;
                            line-height: 25px; padding-left: 4%; font-weight: 600;">
            <em><?= $model->name ?></em></h6>
        <h6 class="item-subtitle mbr-fonts-style mt-1 display-7 text-left" style="background-color: rgba(0,0,0,0.5); position: absolute; width: 50%; bottom: 0%; color: white; margin-bottom: 0px;
                            line-height: 25px; padding-left: 4%;">
            <em><?= $model->small_description ?></em></h6>
    </div>
</div>


