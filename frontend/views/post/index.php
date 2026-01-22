<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
setViewParam('liActive', 'home');
$this->title = t('Posts');
?>

<section class="header13 cid-sihzndO6eA mbr-fullscreen" id="header13-1c" style="background-image: url('<?= imageURL('mbr-1920x1282.jpg') ?>');">
    <div class="mbr-overlay" style="opacity: 0.2; background-color: rgb(53, 53, 53);"></div>
    <div class="align-center container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <h1 class="mbr-section-title mbr-fonts-style mb-3 display-1">
                    <div style="direction: rtl;"><?= t('Posts') ?></div>
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



<section class="features10 cid-si3RgMzQ1g border-top" id="features11-o" style="padding-top: 0;">
    <div class="container">
        <div class="title">
            <h3 class="mbr-section-title mbr-fonts-style mb-4 display-2">
                <strong><?= t('Posts')?></strong>
            </h3>
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
            <?php foreach ($posts as $post): ?>
                <div class="col mb-4">
                    <div class="card h-100">
                        <img src="<?= $post->imageUrl ?>" class="card-img-top" alt="<?= Html::encode($post->title) ?>" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?= Html::encode($post->title) ?></h5>
                            <p class="card-title"> <?= 'URL:'. $post->url ?></p>
                            <p class="card-text">
                                <?= Html::encode(substr($post->content, 0, 150)) ?>...
                            </p>
                            <a href="<?= Yii::$app->urlManager->createUrl(['post/view', 'id' => $post->id]) ?>" class="btn btn-primary">
                                <?= t('Read More') ?>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>



