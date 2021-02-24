
<?php
use yii\widgets\Pjax;
use yii\widgets\ListView;

/* @var $this yii\web\View */
$this->title = t('Offline Training');
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

<section class="features10 cid-si3RgMzQ1g border-top" id="features11-o" style="padding-top: 0%; padding-bottom: 1%;">
    <div class="container">
        <div class="title">
            <h3 class="mbr-section-title mbr-fonts-style mb-4 display-2">
                <strong><?= t('Offline Training') ?></strong>
            </h3>
        </div>
    </div>
</section>

<?php if (Yii::$app->session->hasFlash('flash_error')): ?>
    <div class="alert alert-danger" role="alert">
        <?= Yii::$app->session->getFlash('flash_error'); ?>
    </div>
<?php endif; ?>
<?php if (Yii::$app->session->hasFlash('flash_warning')): ?>
    <div class="alert alert-warning" role="alert">
        <?= Yii::$app->session->getFlash('flash_warning'); ?>
    </div>
<?php endif; ?>


<section class="pricing2 cid-sihA3oOBNP" id="pricing2-1e">
    <div class="container">
        <div class="row justify-content-center">
            <?php foreach ($offlineTrainings as $course){?>

                <div class="col-12 col-md-6 align-center col-lg-4 mb-4" style=" max-width: 90%; ">
                    <div class="bg-image" style="background-image: url(<?= $course->imageUrl ?>);"></div>

                    <div class="bg-text">
                        <div class="plan" style="">

                            <?php
                            $color = '';
                            if($course->text_color){
                                $color = 'color: '.$course->text_color;
                            }
                            ?>
                            <a class="bg-content"
                               href="<?= Yii::$app->urlManager->createUrl("/courses/details?id=".$course->id) ?>" style="<?= $color ?>">


                                <div class="plan-header pt-3">
                                    <h6 class="plan-title mbr-fonts-style mb-3 display-5">
                                        <strong><?= $course->name ?></strong>
                                    </h6>
                                    <div class="plan-price">
                                        <p class="price mbr-fonts-style m-0 display-1" style="direction: <?= $direction ?>">
                                            <strong><?= $course->price.' '.t('KD') ?> </strong>
                                        </p>
                                        <p class="price-term mbr-fonts-style mb-3 display-7" style="font-size: 0.9rem;direction: <?= $direction ?>">
                                            <strong>
                                                <?= t('From: ').date('M-d', strtotime($course->start_date))
                                                .' - '.t('Until: ')
                                                .date('M-d', strtotime($course->end_date)) ?>
                                            </strong>
                                        </p>
                                        <p class="price-term mbr-fonts-style mb-3 display-7" style="font-size: 0.9rem;direction: <?= $direction ?>">
                                            <strong>
                                                <?= ($course->seats_number - $course->requestsNumber). ' '. t('Seats available') ?>
                                            </strong>
                                        </p>
                                    </div>
                                </div>
                                <div class="plan-body">
                                    <div class="plan-list mb-3">
                                        <ul class="list-group mbr-fonts-style list-group-flush display-7 <?php
                                        if(Yii::$app->language != 'ar'){
                                            echo 'text-left';
                                        } else {
                                            echo 'text-right';
                                        }
                                        ?>">
                                            <?php foreach ($course->placeContents as $oneContent) { ?>
                                                <li class="list-group-item bg-transparent" style="padding: 5px 15px;">
                                                    <?= $oneContent->content ?>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </a>


                        </div>
                    </div>




                </div>

            <?php } ?>
        </div>
    </div>
</section>






