<?php
$this->title = $model->name;

$direction = 'ltr';
$float = 'left';
if(Yii::$app->language == 'ar'){
    $direction = 'rtl';
    $float = 'right';
}
?>

<section class="features16 cid-si5rjWjPLu" id="features17-16">

    <div class="container">
        <div class="mySlides" style="display: block;">
            <img src="<?= $model->imageUrl ?>" style="width:100%" class="">
        </div>

        <?php foreach ($model->placeImages as $frame){  ?>
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
            <?php foreach ($model->placeImages as $key => $frame){  ?>
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
                        <p class="price-term mbr-fonts-style mb-3 display-7" style="font-size: 0.9rem;direction: <?= $direction ?>">
                            <strong>
                                <?= t('From: ').date('M-d', strtotime($model->start_date))
                                .' - '.t('Until: ')
                                .date('M-d', strtotime($model->end_date)) ?>
                            </strong>
                        </p>
                        <p class="price-term mbr-fonts-style mb-3 display-7" style="font-size: 0.9rem;direction: <?= $direction ?>">
                            <strong>
                                <?= ($model->seats_number - $model->requestsNumber). ' '. t('Seats available') ?>
                            </strong>
                        </p>
                        <div class="plan-list mb-3">
                            <ul class="list-group mbr-fonts-style list-group-flush display-7 <?php
                            if(Yii::$app->language != 'ar'){
                                echo 'text-left';
                            } else {
                                echo 'text-right';
                            }
                            ?>">
                                <?php foreach ($model->placeContents as $oneContent) { ?>
                                    <li class="list-group-item bg-transparent" style="padding: 5px 15px;">
                                        <?= $oneContent->content ?>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <?php if($model->video){ ?>
                            <div class="video-container">
                                <video class="video" preload="auto" controls="">
                                    <source src="<?= $model->videoUrl ?>">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        <?php } ?>

                        <?php if($model->isRequested){ ?>
                            <div class="mbr-section-btn mt-3 align-center">
                                <a class="btn btn-success display-4">
                                    <?= t('Request Sent') ?>
                                </a>
                            </div>
                        <?php } elseif(($model->seats_number - $model->requestsNumber) > 0){ ?>
                            <div class="mbr-section-btn mt-3 align-center">
                                <a class="btn btn-secondary display-4 btn-gray" href="<?= Yii::$app->urlManager->createUrl("/request/course-check-out?id=".$model->id) ?>">
                                    <?= t('Subscribe Now') ?>
                                </a>
                            </div>
                        <?php } else { ?>
                            <div class="mbr-section-btn mt-3 align-center">
                                <a class="btn btn-primary display-4">
                                    <?= t('Class is full') ?>
                                </a>
                            </div>
                        <?php } ?>
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




















