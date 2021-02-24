<?php
use yii\widgets\Pjax;
use yii\widgets\ListView;
use kartik\select2\Select2;
use common\models\Place;
use yii\helpers\ArrayHelper;
use common\enums\ActiveInactiveStatus;
use common\enums\PlaceType;
use dosamigos\datepicker\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
setViewParam('liActive', 'home');
$this->title = t('Art Table');
$direction = 'ltr';
$float = 'left';
if(Yii::$app->language == 'ar'){
    $direction = 'rtl';
    $float = 'right';
}
?>

<section class="header10 mbr-fullscreen" id="header10-7">
    <img src="<?= imageURL('tables_1.png') ?>" name="myImage" />
</section>

<section class="features4" id="features4-8" style="margin-top: 5%;">
    <div class="container">
        <div class="row mb-4 mx-auto" style="direction: <?= $direction ?>">

            <?php
            $form = ActiveForm::begin([
                'options' => [
                    'style' => 'width: 100%;',
                ],
                'method' => 'get',
                'action' => Yii::$app->urlManager->createUrl("/request/package-check-out")
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
//<label>'.t('Select Table:').'</label>
//                        <div class="">
//          {input}{error}{hint}
//'
//                ])->widget(Select2::classname(), [
//                    'data' => ArrayHelper::map(Place::find()
//                        ->andWhere(['type' => PlaceType::package])
//                        ->andWhere(['status'=>ActiveInactiveStatus::active])
//                        ->all(), 'id', 'namePrice'),
//                    'options' => [
//                        'placeholder' => t('Select Table...'),
//                        'class' => 'select_class',
//                    ],
//                ]);
                ?>
                <label for="selectImage" class="form-label"><?= t('Select Table:') ?></label>
                <select class="form-select select_class" id="selectImage" name="Request[place_id]">
                    <option value="0"><?= t('Please Choose a Table to reserve') ?></option>
                    <?php
                     $tables = Place::find()
                        ->andWhere(['type' => PlaceType::package])
                        ->andWhere(['status'=>ActiveInactiveStatus::active])
                        ->all();
                     foreach ($tables as $one){
                         $disabled = '';
                         if($one->isBooked){
                             $disabled = 'disabled';
                         }
                         ?>
                         <option value="<?= $one->id ?>" <?= $disabled ?>><?= $one->namePriceAvailableDate ?></option>
                     <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <?php
//                echo $form->field($model, 'price_unit_number')->textInput([
//                    'type' => 'number'
//                ])
                ?>
            </div>
            <div class="mb-3">
                <?php
                echo $form->field($model, 'start_date')->widget(DatePicker::className(), [
                    'inline' => false,
                    'addon' => false,//To disable addon button with its events
//                    'disabled' => !empty($model->doa),
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-m-dd',
                        'todayHighlight' => true
                    ]
                ]);
                ?>
            </div>
            <div id="summery">

            </div>
            <div class="mb-3">
                <button id="submit_btn" class="btn btn-primary display-4" type="submit">
                    <?=t('Submit') ?>
                </button>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</section>

<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"-->
<!--        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"-->
<!--        crossorigin="anonymous"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<?php $this->registerJsFile('@web/js/custom/package_index.js'); ?>

<style>
    form > .mb-3{
        text-align: <?= $float ?>;
    }
</style>

<style>
    @media (max-width: 450px){
        .mbr-fullscreen {
            padding-top: 19%;
        }
    }
</style>



