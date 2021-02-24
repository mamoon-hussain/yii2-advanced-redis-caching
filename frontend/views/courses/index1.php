<?php
use yii\widgets\Pjax;
use yii\widgets\ListView;
use common\enums\CourseType;

/* @var $this yii\web\View */
setViewParam('liActive', 'home');
$this->title = t('Art Training');
?>

<section class="header13 cid-sihzndO6eA mbr-fullscreen" id="header13-1c" style="background-image: url('<?= imageURL('mbr-1920x1282.jpg') ?>');">
    <div class="mbr-overlay" style="opacity: 0.2; background-color: rgb(53, 53, 53);"></div>
    <div class="align-center container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <h1 class="mbr-section-title mbr-fonts-style mb-3 display-1">
                    <div style="direction: rtl;"><?= t('Artzona training courses') ?></div>
                </h1>
                <p class="mbr-text mbr-fonts-style mb-3 display-7"></p>
                <div style="direction: rtl;">
                    <span style="font-size: 1.2rem;">
                        <?= t('In Artzona, we strive to develop and transfer the participants from the painter stage to what is greater skill, art and knowledge.') ?>
                    </span>
                </div>
                <p></p>
            </div>
        </div>
    </div>
</section>

<section class="features4 cid-si3gLq8V47" id="features4-8" style="background-image: url('<?= imageUrl('/background3') ?>');padding-top: 4%;">
    <div class="mbr-overlay" style="opacity: 0.7; background-color: rgb(53, 53, 53);"></div>
    <div class="container">
        <h2 style="text-align: center; color: white;font-weight: bold;"><?= t('Training Categories')?></h2>
        <div class="row mt-4">
            <div class="item features-image сol-12 col-md-6 col-lg-4">
                <a href="<?= Yii::$app->urlManager->createUrl("/courses/offline-training") ?>">
                    <div class="item-img" style="position: relative;">
                        <img src="<?= imageURL('mbr-3-1920x1080.jpg') ?>"  alt="<?= t('Offline Training') ?>" title="">
                        <h5 class="item-title mbr-fonts-style display-5 text-center"
                            style="background-color: rgba(0,0,0,0.5); position: absolute; width: 100%; bottom: 0%; color: white; margin-bottom: 0%; line-height: 2;">
                            <strong><?= t('Offline Training') ?></strong></h5>
                    </div>
                </a>
            </div>
            <div class="item features-image сol-12 col-md-6 col-lg-4">
                <a href="<?= Yii::$app->urlManager->createUrl("/courses/online-training") ?>">
                    <div class="item-img" style="position: relative;">
                        <img src="<?= imageURL('mbr-1920x1277.jpg') ?>" alt="" title="">
                        <h5 class="item-title mbr-fonts-style display-5 text-center"
                            style="background-color: rgba(0,0,0,0.5); position: absolute; width: 100%; bottom: 0%; color: white; margin-bottom: 0%; line-height: 2;">
                            <strong><?= t('Online Training') ?></strong></h5>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>




 