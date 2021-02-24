<?php
$this->title = $model->name;
?>

<section class="features16 cid-si5rjWjPLu" id="features17-16">

    <div class="container">
        <div class="mySlides" style="display: block;">
            <img src="<?= $model->imageUrl ?>" style="width:100%" class="">
        </div>

        <?php foreach ($frames as $frame){  ?>
            <div class="mySlides" style="display: none;">
                <img src="<?= $frame->imageUrl ?>" style="width:100%" class="animate__animated animate__delay-1s animate__fadeInUp">
            </div>
        <?php }  ?>

        <a class="prev" onclick="plusSlides(-1)">❮</a>
        <a class="next" onclick="plusSlides(1)">❯</a>

        <div class="row">
            <div class="column">
                <img class="demo cursor active" src="<?= $model->imageUrl ?>" style="width:100%" onclick="currentSlide(1)">
            </div>
            <?php foreach ($frames as $key => $frame){  ?>
                <div class="column">
                    <img class="demo cursor" src="<?= $frame->imageUrl ?>" style="width:100%" onclick="currentSlide(<?= $key+2 ?>)">
                </div>
            <?php }  ?>
        </div>
    </div>

    <div class="container">
        <div class="content-wrapper">
            <div class="row align-items-center">
                <hr/>
                <div class="row">
                    <div class="col-8">
                        <div class="text-wrapper">
                            <h6 class="card-title mbr-fonts-style display-5">
                                <strong><?= $model->name ?></strong>
                            </h6>
                        </div>
                    </div>
                    <div class="col-4" style="padding: 0">
                        <div class="text-wrapper">
                            <h4 class="card-title mbr-fonts-style display-5 badge badge-secondary" style="float: right;">
                                <?= $model->price.t(' KD') ?>
                            </h4>
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="col-12 col-lg">
                    <div class="text-wrapper">
                        <p class="mbr-text mbr-fonts-style mb-4 display-4">
                            <?= $model->description ?>
                        </p>
                        <?php if($model->video){ ?>
                            <div class="video-container">
                                <video class="video" preload="auto" controls="">
                                    <source src="<?= $model->videoUrl ?>">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        <?php } ?>

                        <?php if(!$request){ ?>
                            <div class="mbr-section-btn mt-3 align-center">
                                <a class="btn btn-primary display-4 btn-gray" href="<?= Yii::$app->urlManager->createUrl("/request/product-check-out?id=".$model->id) ?>">
                                    <?= t('Buy Now') ?>
                                </a>
                            </div>
                        <?php } else{ ?>
                            <div class="mbr-section-btn mt-3 align-center">
                                <a href="#" class="btn btn-secondary display-4" style="background-color: #f87e00 !important;
    border-color: #f87e00 !important;">
                                    <?= t('Sold Out') ?>
                                </a>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>



</section>


<?php $this->registerCssFile('@web/css/custom/painting_details.css'); ?>
<?php $this->registerJsFile('@web/js/custom/painting_details.js', ['depends' => [yii\web\JqueryAsset::className()]]); ?>

<style>
    .column {
        margin: auto;
        width: 20% !important;
    }
</style>




















