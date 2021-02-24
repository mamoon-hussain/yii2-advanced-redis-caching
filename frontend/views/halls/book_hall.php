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


<section class="features4" id="features4-8">
    <div class="container" style="padding-top: 50px">

        <div class="row mb-4 mx-auto" style="direction: <?= $direction ?>">
            <?php
            $form = ActiveForm::begin([
                'options' => [
                    'style' => 'width: 100%;',
                ],
                'method' => 'get',
                'action' => Yii::$app->urlManager->createUrl("/request/hall-check-out")
            ]);
            ?>

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

            <div class="mb-3">
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
                        if($id == $one->id){
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
            <div class="mb-3"
            <?php
            echo $form->field($model, 'class_period', [
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
<!--        <div class="mb-3">-->
            <?php
//            echo $form->field($model, 'price_unit_number')->textInput([
//                'type' => 'number'
//            ])
            ?>
<!--        </div>-->
<!--        <div class="mb-3">-->
            <?php
//            echo $form->field($model, 'start_date')->widget(DatePicker::className(), [
//                'inline' => false,
//                'addon' => false,//To disable addon button with its events
////                    'disabled' => !empty($model->doa),
//                'clientOptions' => [
//                    'autoclose' => true,
//                    'format' => 'yyyy-m-dd',
//                    'todayHighlight' => true
//                ]
//            ]);
            ?>
<!--        </div>-->
        <?php
        echo '<div class="form-group">';
        echo '<label class="control-label">'.$model->getAttributeLabel('date_range') .' </label>';
        echo '<div class="input-group drp-container">';
        echo  \kartik\daterange\DateRangePicker::widget([
                'model'=>$model,
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
</section>

<style>
    .select2-container{
        direction: <?= $direction ?>;
        text-align: <?= $float ?>;
    }
    form > .mb-3{
        text-align: <?= $float ?>;
    }
    .form-group{
        text-align: <?= $float ?>;
    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<?php $this->registerJsFile('@web/js/custom/hall_index.js'); ?>

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