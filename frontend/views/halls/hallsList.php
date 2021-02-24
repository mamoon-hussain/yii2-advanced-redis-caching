

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


<div class="col mb-4">
    <a href="<?= Yii::$app->urlManager->createUrl("hall/hall-details?id=".$model->id) ?>">
        <div class="card text-white h-100">
            <img src="<?=$model->imageUrl ?>" class="card-img-top" alt="Sketch Books">
            <div class="card-img-overlay bg-dark" style="top: 60%; opacity: 0.75; bottom: 15px;">
                <h5 class="card-title text-center" style="line-height: 0%;"><?= $model->name ?></h5>
            </div>
        </div>
    </a>
</div>




