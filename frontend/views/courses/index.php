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



<section class="features10 cid-si3RgMzQ1g border-top" id="features11-o" style="padding-top: 0%;">
    <div class="container">
        <div class="title">
            <h3 class="mbr-section-title mbr-fonts-style mb-4 display-2">
                <strong><?= t('Training Categories')?></strong>
            </h3>
        </div>
        <!-- ------------------------------------------------------------ -->

        <div class="card-deck border-bottom">
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4">
                <div class="col mb-4">
                    <a href="<?= Yii::$app->urlManager->createUrl("/courses/offline-training") ?>">
                        <div class="card text-white h-100">
                            <img src="<?= imageURL('mbr-3-1920x1080.jpg') ?>" style="width: 100%; height: 100%" class="card-img-top"
                                 alt="Offline Training">
                            <div class="card-img-overlay bg-dark" style="bottom: 15px; top: 50%; opacity: 0.75;">
                                <h5 class="card-title text-center" style="line-height: 0%;"><?= t('Offline') ?></h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col mb-4">
                    <a href="<?= Yii::$app->urlManager->createUrl("/courses/online-training") ?>">
                        <div class="card text-white h-100">
                            <img src="<?= imageURL('mbr-1920x1277.jpg') ?>" style="width: 100%; height: 100%" class="card-img-top" alt="Online Training">
                            <div class="card-img-overlay bg-dark" style="bottom: 15px; top: 50%; opacity: 0.75;">
                                <h5 class="card-title text-center" style="line-height: 0%;"><?= t('Online') ?></h5>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- ------------------------------------------------------------ -->
    </div>
</section>



 