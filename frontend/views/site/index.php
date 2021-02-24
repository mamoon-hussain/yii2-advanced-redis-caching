<?php
use yii\widgets\Pjax;
use yii\widgets\ListView;

/* @var $this yii\web\View */
setViewParam('liActive', 'home');
$this->title = t(Yii::$app->params['title']);
?>



<section class="header10 cid-si3gh69yvp mbr-fullscreen pb-0" id="header10-7">
    <div class="align-center container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-9">
                <img src="<?= $app_info->imageUrl ?>"
                     style="display: initial; height: 80%; width: 80%">

            </div>
            <div>
                <?= $app_info->home_description ?>
            </div>
        </div>
    </div>
</section>


<?php if($app_info->videoUrl){ ?>
    <section class="header10 mbr-fullscreen py-0" style="min-height: fit-content; margin-top: 5%;" id="header10-7">
        <div class="align-center container">
            <div class="row justify-content-center">
                <div class="video-container">
                    <video autoplay muted loop playsinline class="video" preload="metadata" >
                        <source src='<?= $app_info->videoUrl ?>' type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </div>
    </section>
<?php } ?>

<section class="features4 cid-si3gLq8V47" id="features4-8" style="background-image: url('<?= imageUrl('/background3') ?>');padding-top: 4%;">
    <div class="mbr-overlay" style="opacity: 0.7; background-color: rgb(53, 53, 53);"></div>
    <div class="container">
        <h2 style="text-align: center; color: white;font-weight: bold;"><?= t('Services') ?></h2>
        <hr style="margin-top: 0; color: white;"/>
        <div class="row mt-4">
            <div class="item features-image сol-12 col-md-6 col-lg-4">
                <a href="<?= Yii::$app->urlManager->createUrl("/paintings/index") ?>">
                    <div class="item-img" style="position: relative;">
                        <img src="<?= imageURL('mbr-696x464.jpg') ?>"  alt="Art Works" title="">
                        <h5 class="item-title mbr-fonts-style display-5 text-center"
                            style="background-color: rgba(0,0,0,0.5); position: absolute; width: 100%; bottom: 0%; color: white; margin-bottom: 0%; line-height: 2;">
                            <strong><?= t('ART WORKS')?></strong></h5>
                    </div>
                </a>
            </div>
            <div class="item features-image сol-12 col-md-6 col-lg-4">
                <a href="<?= Yii::$app->urlManager->createUrl("/tools/index") ?>">
                    <div class="item-img" style="position: relative;">
                        <img src="<?= imageURL('mbr-3-696x464.jpg') ?>" alt="" title="">
                        <h5 class="item-title mbr-fonts-style display-5 text-center"
                            style="background-color: rgba(0,0,0,0.5); position: absolute; width: 100%; bottom: 0%; color: white; margin-bottom: 0%; line-height: 2;">
                            <strong><?= t('ART TOOLS')?></strong></h5>
                    </div>
                </a>
            </div>
            <div class="item features-image сol-12 col-md-6 col-lg-4">
                <a href="<?= Yii::$app->urlManager->createUrl("/courses/index") ?>">
                    <div class="item-img" style="position: relative;">
                        <img src="<?= imageURL('mbr-1-696x392.jpg') ?>" alt="" title="">
                        <h5 class="item-title mbr-fonts-style display-5 text-center"
                            style="background-color: rgba(0,0,0,0.5); position: absolute; width: 100%; bottom: 0%; color: white; margin-bottom: 0%; line-height: 2;">
                            <strong><?= t('ART TRAINING')?></strong></h5>
                    </div>
                </a>
            </div>
            <div class="item features-image сol-12 col-md-6 col-lg-4">
                <a  href="<?= Yii::$app->urlManager->createUrl("/packages/index") ?>">
                    <div class="item-img" style="position: relative;">
                        <img src="<?= imageURL('mbr-1-696x464.jpg') ?>" alt="" title="">
                        <h5 class="item-title mbr-fonts-style display-5 text-center"
                            style="background-color: rgba(0,0,0,0.5); position: absolute; width: 100%; bottom: 0%; color: white; margin-bottom: 0%; line-height: 2;">
                            <strong><?= t('ART TABLES')?></strong></h5>
                    </div>
                </a>
            </div>
            <div class="item features-image сol-12 col-md-6 col-lg-4">
                <a  href="<?= Yii::$app->urlManager->createUrl("/halls/index") ?>">
                    <div class="item-img" style="position: relative;">
                        <img src="<?= imageURL('mbr-2-696x464.jpg') ?>" alt="" title="">
                        <h5 class="item-title mbr-fonts-style display-5 text-center"
                            style="background-color: rgba(0,0,0,0.5); position: absolute; width: 100%; bottom: 0%; color: white; margin-bottom: 0%; line-height: 2;">
                            <strong><?= t('ART CLASSES')?></strong></h5>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<style>
    .mbr-fullscreen {
        padding-top: 5rem;
        padding-bottom: 0rem;
        min-height: 40vh;
    }
</style>

