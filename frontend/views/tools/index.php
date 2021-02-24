<?php
use yii\widgets\Pjax;
use yii\widgets\ListView;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
setViewParam('liActive', 'home');
$this->title = t('Art Tools');
$direction = 'ltr';
$float = 'left';
if(Yii::$app->language == 'ar'){
    $direction = 'rtl';
    $float = 'right';
}
?>


<section class="features6 cid-si3RehqZz6" id="features7-n" style="padding-bottom: 0%;">
    <div class="container">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php
                $activeLi = 'active';
                $activeLiAdded = false;
                foreach ($tools_offers as $singleTool){
                    if (!$activeLiAdded){
                        $activeLi='active';
                        $activeLiAdded = true;
                    } else{
                        $activeLi='';
                    }
                    ?>
                    <div class="carousel-item <?= $activeLi ?>">
                        <div class="card-wrapper">
                            <div class="row align-items-center">
                                <div class="col-12 col-lg-4">
                                    <div class="image-wrapper">
                                        <img src="<?= $singleTool->imageUrl ?>" alt="slide-001">
                                    </div>
                                </div>
                                <div class="col-6 align-left">
                                    <div class="text-wrapper">
                                        <span class="card-title mbr-fonts-style display-5" style="font-size: 20px; line-height: 20px;">
                                            <strong><?= $singleTool->name ?></strong>
                                        </span`>
                                    </div>
                                </div>
                                <div class="col-6 align-right">
                                    <div class="text-box">
                                        <div class="cost" style="direction: <?= $direction ?>">
                                            <span class="currentcost mbr-fonts-style pr-2 display-2" style="font-size: 20px; line-height: 20px;">
                                                <?= $singleTool->price.' '. t('KD') ?>
                                            </span>
                                            <span class="oldcost mbr-fonts-style display-2" style="font-size: 20px; line-height: 20px;">
                                                <?= $singleTool->old_price.' '. t('KD') ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <p class="mbr-text mbr-fonts-style display-4" style="text-align: <?= $float ?>">
                                        <?= $singleTool->description ?>
                                    </p>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="mbr-section-btn">
                                        <a href="<?= Yii::$app->urlManager->createUrl("/request/product-check-out?id=".$singleTool->id) ?>" class="btn btn-primary display-4">
                                            <?= t('Buy Now') ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev" style="bottom: 50%;">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next" style="bottom: 50%;">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</section>

<section class="features10 cid-si3RgMzQ1g border-top" id="features11-o" style="padding-top: 0%;">
    <div class="container">
        <div class="title">
            <h3 class="mbr-section-title mbr-fonts-style mb-4 display-2">
                <strong><?= t('Product Categories') ?></strong>
            </h3>
        </div>
        <!-- ------------------------------------------------------------ -->
        <div class="card-deck border-bottom">
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4">

                <?php
                foreach ($categoriesDataProvider->getModels() as $model){
                    ?>
                    <div class="col mb-4">
                        <a href="<?= Yii::$app->urlManager->createUrl("category/category-tools?id=".$model->id) ?>">
                            <div class="card text-white h-100">
                                <img src="<?=$model->imageUrl ?>" class="card-img-top" alt="Sketch Books" style="height: 100%;
    border-radius: 6px;">
                                <div class="card-img-overlay bg-dark" style="top: 75%; opacity: 0.75; bottom: 0px;padding: unset;padding-top: 2%">
                                    <h5 class="card-title text-center" style=""><?= $model->name ?></h5>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
        <!-- ------------------------------------------------------------ -->
    </div>
</section>

<style>
    p {
        text-align: <?= $float ?>;
    }
</style>

