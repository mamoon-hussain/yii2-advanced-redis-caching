<?php
$this->title = $category->name;

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


<section class="features10 cid-si3RgMzQ1g border-top" id="features11-o" style="padding-top: 4%;">
    <div class="container">
        <!-- ----------------------------------------------------------------------------------------- -->
        <div class="card-deck">
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4">
                <?php foreach ($category->products as $tool){ ?>
                    <div class="col mb-4">
                        <div class="card h-100">
                            <img src="<?= $tool->imageUrl ?>" class="card-img-top" alt="...">
                            <div class="card-body" style="padding: 5% 0%;">

                                <div class="row">
                                    <div class="col-6">
                                        <span class="card-title align-middle"><?= $tool->name ?></span>
                                    </div>
                                    <div class="col-6">
                                        <p class="card-title badge badge-secondary" style="margin-top: 7px;direction: <?= $direction ?>; float: right">
                                            <?= $tool->price. t(' KD') ?>
                                        </p>
                                    </div>
                                </div>
                                <span class="card-text text-muted"><small><?= $tool->description ?></small></span>
                                <div class="mbr-section-btn">
                                    <a href="<?= Yii::$app->urlManager->createUrl("/request/product-check-out?id=".$tool->id) ?>" class="btn btn-primary btn-sm">
                                        <?= t('Buy Now') ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }?>


            </div>
        </div>
        <!-- ----------------------------------------------------------------------------------------- -->

    </div>
</section>

<style>
    p {
        text-align: <?= $float ?>;
    }
</style>
