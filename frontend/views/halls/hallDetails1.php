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
        <?php if (Yii::$app->session->hasFlash('flash_error')): ?>
            <div class="alert alert-danger" role="alert">
                <?= Yii::$app->session->getFlash('flash_error'); ?>
            </div>
        <?php endif; ?>
        <?php if (Yii::$app->session->hasFlash('flash_success')): ?>
            <div class="alert alert-success" role="alert">
                <?= Yii::$app->session->getFlash('flash_success'); ?>
            </div>
        <?php endif; ?>

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
                    <!--<div class="col-4" style="padding: 0">
                        <div class="text-wrapper">
                            <h4 class="card-title mbr-fonts-style display-5 badge badge-secondary" style="float: right;direction: <?= $direction ?>">
                                <?= $model->price.t(' KD') . t(' (for Noon Period)') ?>
                            </h4>
                            <h4 class="card-title mbr-fonts-style display-5 badge badge-secondary" style="float: right;direction: <?= $direction ?>">
                                <?= $model->price_2.t(' KD') . t(' (for Afternoon Period)') ?>
                            </h4>
                        </div>
                    </div>-->
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

                    </div>
                </div>
            </div>

            <hr/>
            <div class="row mb-4 mx-auto" style="direction: <?= $direction ?>">
                <h3><?= t('Book Now') ?></h3>
                <?php
                $form = ActiveForm::begin([
                    'options' => [
                        'style' => 'width: 100%;',
                    ],
                    'method' => 'get',
                    'action' => Yii::$app->urlManager->createUrl("/request/hall-check-out")
                ]);
                ?>



                <div class="" style="display: none">
                    <div class="mb-3 ">
                        <?php
                        //                echo $form->field($model, 'place_id', [
                        //                    'template' => '
                        //<label>'.t('Select Class:').'</label>
                        //                        <div class="">
                        //          {input}{error}{hint}
                        //'
                        //                ])->widget(Select2::classname(), [
                        //                    'data' => ArrayHelper::map(Place::find()
                        //                        ->andWhere(['type' => PlaceType::hall])
                        //                        ->andWhere(['status'=>ActiveInactiveStatus::active])
                        //                        ->all(), 'id', 'name'),
                        //                    'options' => [
                        //                        'placeholder' => t('Select Class...'),
                        //                        'class' => 'select_class',
                        //                    ],
                        //                ]);
                        ?>
                        <label for="selectImage" class="form-label"><?= t('Select Class:') ?></label>
                        <select class="form-select select_class" id="selectImage" name="Request[place_id]">
                            <option value="0"><?= t('Please Choose a Class to reserve') ?></option>
                            <?php
                            $tables = Place::find()
                                ->andWhere(['type' => PlaceType::hall])
                                ->andWhere(['status'=>ActiveInactiveStatus::active])
                                ->all();
                            foreach ($tables as $one){
                                $disabled = '';
                                $selected = '';
                                if($model->id == $one->id){
                                    $selected = 'selected';
                                }
//                        if($one->isBooked){
//                            $disabled = 'disabled';
//                        }
                                ?>
                                <option <?= $selected ?> value="<?= $one->id ?>" <?= $disabled ?>><?= $one->name ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="mb-3"
                <?php
                echo $form->field($request, 'class_period', [
                    'template' => '
<label>'.t('Select Period:').'</label>
                        <div class="">
          {input}{error}{hint}              
'
                ])->widget(Select2::classname(), [
                    'data' => ClassPeriod::Labels(),
                    'options' => [
                        'placeholder' => t('Select Class Period...'),
                        'class' => 'form-select'
                    ],
                ]);
                ?>
            </div>
            <?php
            echo '<div class="form-group">';
            echo '<label class="control-label">'.$request->getAttributeLabel('date_range') .' </label>';
            echo '<div class="input-group drp-container">';
            echo  \kartik\daterange\DateRangePicker::widget([
                    'model'=>$request,
                    'attribute' => 'date_range',
                    'useWithAddon'=>true,
                    'convertFormat'=>true,
                    'startAttribute' => 'start_date',
                    'endAttribute' => 'end_date',
                    'pluginOptions'=>[
                        'locale'=>['format' => 'Y-m-d'],
                    ]
                ]) . '<div class="input-group-append">
    <span class="input-group-text">
        <i class="fas fa-calendar-alt"></i>
    </span>
</div>';
            echo '</div>';
            echo '</div>'; ?>
            <div id="summery">

            </div>
            <div class="mb-3">
                <button class="btn btn-primary display-4" type="submit">
                    <?=t('Submit') ?>
                </button>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
        </div>
    </div>



</section>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<?php $this->registerCssFile('@web/css/custom/painting_details.css'); ?>
<?php $this->registerJsFile('@web/js/custom/painting_details.js', ['depends' => [yii\web\JqueryAsset::className()]]); ?>
<?php $this->registerJsFile('@web/js/custom/hall_index.js'); ?>

<style>
    .column {
        margin: auto;
        width: 20% !important;
    }
</style>




















