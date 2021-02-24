<?php
$this->title = t(Yii::$app->params['title']);
$this->params['breadcrumbs'][] = $this->title;

$direction = 'ltr';
$float = 'left';
if(Yii::$app->language == 'ar'){
    $direction = 'rtl';
    $float = 'right';
}
?>
<section class="header13 cid-sihzndO6eA mbr-fullscreen" id="header13-1c" style="background-image: url('<?= imageURL('mbr-1920x1282.jpg') ?>');">
    <div class="mbr-overlay" style="opacity: 0.2; background-color: rgb(53, 53, 53);"></div>
    <div class="align-center container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <h1 class="mbr-section-title mbr-fonts-style mb-3 display-1">
                    <div style="direction: rtl;"><?= t('Terms & Conditions') ?></div>
                </h1>
                <p></p>
            </div>
        </div>
    </div>
</section>

<section class="features10 cid-si3RgMzQ1g border-top" id="features11-o" style="padding-top: 0%; direction: <?= $direction ?>">
    <div class="container">
        <div class="title">
            <h3 class="mbr-section-title mbr-fonts-style mb-4 display-2">

            </h3>
        </div>
        <!-- ------------------------------------------------------------ -->

        <div class="card-deck border-bottom">
            <?= $model->description ?>
        </div>
        <!-- ------------------------------------------------------------ -->
    </div>
</section>

