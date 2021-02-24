<?php
/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
$this->title = t('Not found');
$this->params['breadcrumbs'][] = $this->title;
$Maintitle = t(Yii::$app->params['title']);
$storeTitle = t(Yii::$app->params['title']);
?>



<section class="header13 cid-sihzndO6eA mbr-fullscreen" id="header13-1c" style="background-image: url('<?= imageURL('mbr-1920x1282.jpg') ?>');">



    <div class="mbr-overlay" style="opacity: 0.2; background-color: rgb(53, 53, 53);"></div>

    <div class="align-center container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <h1 class="mbr-section-title mbr-fonts-style mb-3 display-1">
                    <div style="direction: rtl;"><?= $this->title ?></div>
                </h1>

                <p class="mbr-text mbr-fonts-style mb-3 display-7"></p>
                <div style="direction: rtl;">
                    <span style="font-size: 1.2rem;">
                        <?= t('The above error occurred while the  server was processing your request.') ?>
                    </span>
                    <br/>
                    <?= t('Please contact us if you think this is a server error. Thank you.') ?>
                </div>
                <p></p>


            </div>
        </div>
    </div>
</section>

