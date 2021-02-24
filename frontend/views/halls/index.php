<?php
use yii\widgets\Pjax;
use yii\widgets\ListView;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\enums\PlaceType;
use common\models\Place;
use common\enums\ActiveInactiveStatus;
use dosamigos\datepicker\DatePicker;
use yii\widgets\ActiveForm;
use common\enums\ClassPeriod;

/* @var $this yii\web\View */
setViewParam('liActive', 'home');
$this->title = t('Art Classes');

$direction = 'ltr';
$float = 'left';
if(Yii::$app->language == 'ar'){
    $direction = 'rtl';
    $float = 'right';
}
?>


<section class="header3 cid-si3MqNY046 mbr-fullscreen" id="header3-j" style="background-image: url(<?= imageUrl('logo.png') ?>);">
    <div class="mbr-overlay" style="opacity: 0.7; background-color: rgb(53, 53, 53);"></div>
    <div class="align-center container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <h1 class="mbr-section-title mbr-fonts-style mb-3 display-2">
                    <strong>
                        <?= $this->title ?>
                    </strong>
                </h1>
            </div>
        </div>
    </div>
</section>

<section class="features3 cid-si3AOTwsav" id="features3-g" style="padding-top: 1%;">
    <div class="container">
        <div class="row mt-4">
            <?php
            foreach ($hallsDataProvider->getModels() as $model){
                ?>
                <div class="item features-image сol-12 col-md-6 col-lg-4" style="width: 50%;">
                    <a href="<?= Yii::$app->urlManager->createUrl("/halls/details?id=".$model->id) ?>">
                        <div class="item-img" style="position: relative;">
                            <img src="<?= $model->imageUrl ?>" alt="">
                            <div class="card-img-overlay bg-dark" style="bottom: 0px; top: 50%; opacity: 0.75;background-color: transparent !important;
    padding: 0;">
                                <h6 class="item-subtitle mbr-fonts-style mt-1 display-7 text-left" style="background-color: rgba(0,0,0); position: absolute; width: 100%; bottom: 0%; color: white; margin-bottom: 24px;
                            line-height: 25px; padding-left: 4%; font-weight: 600;">
                                    <em><?= $model->name ?></em>
                                </h6>
                                <h6 class="item-subtitle mbr-fonts-style mt-1 display-7 text-left" style="background-color: rgba(0,0,0); position: absolute; width: 100%; bottom: 0%; color: white; margin-bottom: 0px;
                            line-height: 25px; padding-left: 4%;">
                                    <em><?= $model->small_description ?></em>
                                </h6>
                            </div>

                        </div>
                    </a>
                </div>
            <?php } ?>

        </div>
    </div>
</section>

<!--<script>-->
<!--    // This is the code to preload the images-->
<!--    var imageList = Array();-->
<!--    for (var i = 1; i <= 3; i++) {-->
<!---->
<!--        imageList[i] = new Image(70, 70);-->
<!--        imageList[i].src = "assets/images/tables_" + i + ".png";-->
<!--    }-->
<!---->
<!--    function switchImage() {-->
<!--        var selectedImage = document.myForm.switch1.options[document.myForm.switch1.selectedIndex].value;-->
<!--        document.myImage.src = imageList[selectedImage].src;-->
<!--    }-->
<!--</script>-->