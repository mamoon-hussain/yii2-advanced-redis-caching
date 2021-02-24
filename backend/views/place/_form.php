<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use common\enums\PlaceType;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\Place;
use common\enums\CourseType;
use dosamigos\datepicker\DatePicker;
//use dosamigos\datepicker\DateRangePicker;
use dosamigos\datetimepicker\DateTimePicker;
use dosamigos\tinymce\TinyMce;
use common\enums\DayMonthEnums;

/* @var $this yii\web\View */
/* @var $model common\models\Place */
/* @var $form yii\widgets\ActiveForm */


setViewParam('liActive', 'places and tickets');

switch ($type) {
    case PlaceType::course:
        setViewParam('liinActive', 'course');
        break;

    case PlaceType::hall:
        setViewParam('liinActive', 'hall');
        break;

    case PlaceType::package:
        setViewParam('liinActive', 'package');
        break;
}

$addon = <<< HTML
<div class="input-group-append">
    <span class="input-group-text">
        <i class="fas fa-calendar-alt"></i>
    </span>
</div>
HTML;
?>
    <div class="panel panel-default">
        <div class="panel-body">

    <div class="place-form">

        <?php $form = ActiveForm::begin(); ?>


                <?php if($type == PlaceType::course) { ?>
                    <div class="row">
                        <div class="col-md-4">
                            <?php echo $form->field($model, 'name')->textInput(); ?>
                        </div>
                        <div class="col-md-4">
                            <?php echo $form->field($model, 'course_type')->widget(Select2::classname(), [
                                'data' => CourseType::Labels(),
                                'options' => [
                                    'class' => 'course_type_select',
                                    'placeholder' => t('Select'),
                                ],
                            ]); ?>
                        </div>
                        <div class="col-md-4">
                            <?php echo $form->field($model, 'text_color')->textInput(); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <?php echo $form->field($model, 'seats_number')->textInput(); ?>
                        </div>
                        <div class="col-md-4">
                            <?php echo $form->field($model, 'price')->textInput()->label(t('Price (/Day)')); ?>
                        </div>
                        <div class="col-md-4">
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
                                ]);
                            echo '</div>';
                            echo '</div>'; ?>
                        </div>
                    </div>

                    <?php
//                    echo $form->field($model, 'description')->widget(TinyMce::className(), [
//                        'options' => ['rows' => 6],
//                        'language' => api_lang(),
//                        'clientOptions' => [
//                            'plugins' => [
//                                "advlist autolink lists link charmap print preview anchor",
//                                "searchreplace visualblocks code fullscreen",
//                                "insertdatetime media table contextmenu paste"
//                            ],
//                            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
//                        ]
//                    ]);
                    ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-card mb-3 card">

                                <div class="card-body">
                                    <h4><?= t('Add Content To Course') ?></h4>
                                    <div id="more-contents">
                                        <?php foreach ($model->placeContents as $onePlaceContent){
                                            echo $this->render('new-contents',[
                                                'model' => $onePlaceContent,
                                                'id' =>$onePlaceContent->id,
                                            ]);
                                        }
                                        ?>
                                    </div>
                                    <?= Html::button('<i class="fa fa-plus-circle"></i>', [
                                        'class' => 'add-new-content btn btn-sm btn-success',
                                        'value' => Yii::$app->urlManager->createUrl("/place/add-new-content")]);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    if(!$model->isNewRecord){
                        $defaultImage = $model->imageUrl;
                    } else {
                        $defaultImage = null;
                    }
                    echo $form->field($model, 'imagesFile')->widget(\bilginnet\cropper\Cropper::className(), [
                        /*
                         * elements of this widget
                         *
                         * buttonId          = #cropper-select-button-$uniqueId
                         * previewId         = #cropper-result-$uniqueId
                         * modalId           = #cropper-modal-$uniqueId
                         * imageId           = #cropper-image-$uniqueId
                         * inputChangeUrlId  = #cropper-url-change-input-$uniqueId
                         * closeButtonId     = #close-button-$uniqueId
                         * cropButtonId      = #crop-button-$uniqueId
                         * browseInputId     = #cropper-input-$uniqueId // fileinput in modal
                        */
                        'uniqueId' => 'image_cropper', // will create automaticaly if not set

                        // you can set image url directly
                        // you will see this image in the crop area if is set
                        // default null
//        'imageUrl' => $defaultImage,

                        'cropperOptions' => [
                            'width' => 400, // must be specified
                            'height' => 280, // must be specified

                            // optional
                            // url must be set in update action
                            'preview' => [
                                'url' => $defaultImage, // (!empty($model->image)) ? Yii::getAlias('@uploadUrl/'.$model->image) : null
                                'width' => 400, // must be specified // you can set as string '100%'
                                'height' => 280, // must be specified // you can set as string '100px'
                            ],

                            // optional // default following code
                            // you can customize
                            'buttonCssClass' => 'btn btn-primary',

                            // optional // defaults following code
                            // you can customize
                            'icons' => [
                                'browse' => '<i class="fa fa-image"></i>',
                                'crop' => '<i class="fa fa-crop"></i>',
                                'close' => '<i class="fa fa-crop"></i>',
                                'zoom-in' => '<i class="fa fa-search-plus"></i>',
                                'zoom-out' => '<i class="fa fa-search-minus"></i>',
                                'rotate-left' => '<i class="fa fa-rotate-left"></i>',
                                'rotate-right' => '<i class="fa fa-rotate-right"></i>',
                                'flip-horizontal' => '<i class="fa fa-arrows-h"></i>',
                                'flip-vertical' => '<i class="fa fa-arrows-v"></i>',
                                'move-left' => '<i class="fa fa-arrow-left"></i>',
                                'move-right' => '<i class="fa fa-arrow-right"></i>',
                                'move-up' => '<i class="fa fa-arrow-up"></i>',
                                'move-down' => '<i class="fa fa-arrow-down"></i>',
                            ]
                        ],

                        // optional // defaults following code
                        // you can customize
                        'label' => $model->getAttributeLabel('imagesFile'),

                        // optional // default following code
                        // you can customize
                        'template' => '{button}{preview}',

                    ]);
                    ?>
                <?php } ?>


                <?php if($type == PlaceType::hall) { ?>
                    <div class="row">
                        <div class="col-md-3">
                            <?php echo $form->field($model, 'name')->textInput(); ?>
                        </div>
                        <div class="col-md-3">
                            <?php echo $form->field($model, 'capacity')->textInput(); ?>
                        </div>
                        <div class="col-md-3">
                            <?php echo $form->field($model, 'price')->textInput()->label(t('Price (Noon Period)')); ?>
                        </div>
                        <div class="col-md-3">
                            <?php echo $form->field($model, 'price_2')->textInput()->label(t('Price (Afternoon Period)')); ?>
                        </div>
                    </div>

                    <?php echo $form->field($model, 'small_description')->textInput(); ?>

                    <?php
                    echo $form->field($model, 'description')->widget(TinyMce::className(), [
                        'options' => ['rows' => 6],
                        'language' => api_lang(),
                        'clientOptions' => [
                            'plugins' => [
                                "advlist autolink lists link charmap print preview anchor",
                                "searchreplace visualblocks code fullscreen",
                                "insertdatetime media table contextmenu paste"
                            ],
                            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
                        ]
                    ]);
                    ?>

                    <?php
                    if(!$model->isNewRecord){
                        $defaultImage = $model->imageUrl;
                    } else {
                        $defaultImage = null;
                    }
                    echo $form->field($model, 'imagesFile')->widget(\bilginnet\cropper\Cropper::className(), [
                        /*
                         * elements of this widget
                         *
                         * buttonId          = #cropper-select-button-$uniqueId
                         * previewId         = #cropper-result-$uniqueId
                         * modalId           = #cropper-modal-$uniqueId
                         * imageId           = #cropper-image-$uniqueId
                         * inputChangeUrlId  = #cropper-url-change-input-$uniqueId
                         * closeButtonId     = #close-button-$uniqueId
                         * cropButtonId      = #crop-button-$uniqueId
                         * browseInputId     = #cropper-input-$uniqueId // fileinput in modal
                        */
                        'uniqueId' => 'image_cropper', // will create automaticaly if not set

                        // you can set image url directly
                        // you will see this image in the crop area if is set
                        // default null
//        'imageUrl' => $defaultImage,

                        'cropperOptions' => [
                            'width' => 400, // must be specified
                            'height' => 280, // must be specified

                            // optional
                            // url must be set in update action
                            'preview' => [
                                'url' => $defaultImage, // (!empty($model->image)) ? Yii::getAlias('@uploadUrl/'.$model->image) : null
                                'width' => 400, // must be specified // you can set as string '100%'
                                'height' => 280, // must be specified // you can set as string '100px'
                            ],

                            // optional // default following code
                            // you can customize
                            'buttonCssClass' => 'btn btn-primary',

                            // optional // defaults following code
                            // you can customize
                            'icons' => [
                                'browse' => '<i class="fa fa-image"></i>',
                                'crop' => '<i class="fa fa-crop"></i>',
                                'close' => '<i class="fa fa-crop"></i>',
                                'zoom-in' => '<i class="fa fa-search-plus"></i>',
                                'zoom-out' => '<i class="fa fa-search-minus"></i>',
                                'rotate-left' => '<i class="fa fa-rotate-left"></i>',
                                'rotate-right' => '<i class="fa fa-rotate-right"></i>',
                                'flip-horizontal' => '<i class="fa fa-arrows-h"></i>',
                                'flip-vertical' => '<i class="fa fa-arrows-v"></i>',
                                'move-left' => '<i class="fa fa-arrow-left"></i>',
                                'move-right' => '<i class="fa fa-arrow-right"></i>',
                                'move-up' => '<i class="fa fa-arrow-up"></i>',
                                'move-down' => '<i class="fa fa-arrow-down"></i>',
                            ]
                        ],

                        // optional // defaults following code
                        // you can customize
                        'label' => $model->getAttributeLabel('imagesFile'),

                        // optional // default following code
                        // you can customize
                        'template' => '{button}{preview}',

                    ]);
                    ?>
                <?php } ?>

                <?php if($type == PlaceType::course || $type == PlaceType::hall) { ?>
                    <?php
                    if($model->isNewRecord) {
                        echo $form->field($model, 'videoFile')->widget(
                            FileInput::classname(),
                            [
                                'options' =>['accept' => 'video/*'],
                            ]

                        );
                    } else {
                        echo $form->field($model, 'videoFile')->widget(
                            FileInput::classname(),
                            [
                                'options' =>['accept' => 'video/*'],
                                'pluginOptions' => [
                                    'initialPreview' =>[
                                        '<video class="img_form" src="'.$model->videoUrl.'" ></video>',
                                    ],
                                    'initialPreviewAsDate' =>true,
                                    'initialPreviewShowDelete' => false,
                                    'overwriteInitial' => true,
                                ],
                            ]
                        );
                    }
                    ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-card mb-3 card">

                                <div class="card-body">
                                    <h4><?= t('Add Images') ?></h4>
                                    <div id="preview-images">
                                        <?php foreach ($model->placeImages as $oneImage){
                                            echo $this->render('new-images',[
                                                'model' => $oneImage,
                                                'id' =>$oneImage->id,
                                            ]);
                                        }
                                        ?>
                                    </div>
                                    <?= Html::button('<i class="fa fa-plus-circle"></i>', [
                                        'class' => 'add-new-image btn btn-sm btn-success',
                                        'value' => Yii::$app->urlManager->createUrl("/place/add-new-image")]);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>



                <?php if($type == PlaceType::package) { ?>
                    <div class="row">
                        <div class="col-md-4">
                            <?php echo $form->field($model, 'name')->textInput(); ?>
                        </div>
                        <div class="col-md-4">
                            <?php echo $form->field($model, 'price')->textInput(); ?>
                        </div>
                        <div class="col-md-4">
<!--                            --><?php
//                            echo '<div class="form-group">';
//                            echo '<label class="control-label">'.$model->getAttributeLabel('date_range') .' </label>';
//                            echo '<div class="input-group drp-container">';
//                            echo  \kartik\daterange\DateRangePicker::widget([
//                                    'model'=>$model,
//                                    'attribute' => 'date_range',
//                                    'useWithAddon'=>true,
//                                    'convertFormat'=>true,
//                                    'startAttribute' => 'start_date',
//                                    'endAttribute' => 'end_date',
//                                    'pluginOptions'=>[
//                                        'locale'=>['format' => 'Y-m-d'],
//                                    ]
//                                ]) . $addon;
//                            echo '</div>';
//                            echo '</div>'; ?>
                            <?=
                            $form->field($model, 'price_unit')->widget(Select2::classname(), [
                                'data' => DayMonthEnums::Labels(),
                            ])
                            ?>
                        </div>
                    </div>




                    <?php
                    if(!$model->isNewRecord){
                        $defaultImage = $model->imageUrl;
                    } else {
                        $defaultImage = null;
                    }
//                    echo $form->field($model, 'imagesFile')->widget(\bilginnet\cropper\Cropper::className(), [
//                        /*
//                         * elements of this widget
//                         *
//                         * buttonId          = #cropper-select-button-$uniqueId
//                         * previewId         = #cropper-result-$uniqueId
//                         * modalId           = #cropper-modal-$uniqueId
//                         * imageId           = #cropper-image-$uniqueId
//                         * inputChangeUrlId  = #cropper-url-change-input-$uniqueId
//                         * closeButtonId     = #close-button-$uniqueId
//                         * cropButtonId      = #crop-button-$uniqueId
//                         * browseInputId     = #cropper-input-$uniqueId // fileinput in modal
//                        */
//                        'uniqueId' => 'image_cropper', // will create automaticaly if not set
//
//                        // you can set image url directly
//                        // you will see this image in the crop area if is set
//                        // default null
////        'imageUrl' => $defaultImage,
//
//                        'cropperOptions' => [
//                            'width' => 400, // must be specified
//                            'height' => 280, // must be specified
//
//                            // optional
//                            // url must be set in update action
//                            'preview' => [
//                                'url' => $defaultImage, // (!empty($model->image)) ? Yii::getAlias('@uploadUrl/'.$model->image) : null
//                                'width' => 400, // must be specified // you can set as string '100%'
//                                'height' => 280, // must be specified // you can set as string '100px'
//                            ],
//
//                            // optional // default following code
//                            // you can customize
//                            'buttonCssClass' => 'btn btn-primary',
//
//                            // optional // defaults following code
//                            // you can customize
//                            'icons' => [
//                                'browse' => '<i class="fa fa-image"></i>',
//                                'crop' => '<i class="fa fa-crop"></i>',
//                                'close' => '<i class="fa fa-crop"></i>',
//                                'zoom-in' => '<i class="fa fa-search-plus"></i>',
//                                'zoom-out' => '<i class="fa fa-search-minus"></i>',
//                                'rotate-left' => '<i class="fa fa-rotate-left"></i>',
//                                'rotate-right' => '<i class="fa fa-rotate-right"></i>',
//                                'flip-horizontal' => '<i class="fa fa-arrows-h"></i>',
//                                'flip-vertical' => '<i class="fa fa-arrows-v"></i>',
//                                'move-left' => '<i class="fa fa-arrow-left"></i>',
//                                'move-right' => '<i class="fa fa-arrow-right"></i>',
//                                'move-up' => '<i class="fa fa-arrow-up"></i>',
//                                'move-down' => '<i class="fa fa-arrow-down"></i>',
//                            ]
//                        ],
//
//                        // optional // defaults following code
//                        // you can customize
//                        'label' => $model->getAttributeLabel('imagesFile'),
//
//                        // optional // default following code
//                        // you can customize
//                        'template' => '{button}{preview}',
//
//                    ]);

//                    if($model->isNewRecord) {
//                        echo $form->field($model, 'imagesFile')->widget(
//                            FileInput::classname(),
//                            [
//                                'options' =>['accept' => 'image/*'],
//                            ]
//
//                        );
//                    } else {
//                        echo $form->field($model, 'imagesFile')->widget(
//                            FileInput::classname(),
//                            [
//                                'options' =>['accept' => 'image/*'],
//                                'pluginOptions' => [
//                                    'initialPreview' =>[
//                                        '<img class="img_form" src="'.$model->imageUrl.'" >',
//                                    ],
//
//                                    'initialPreviewAsDate' =>true,
//                                    'initialPreviewShowDelete' => false,
//                                    'overwriteInitial' => true,
//                                ],
//                            ]
//                        ); }
                        ?>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-card mb-3 card">

                                <div class="card-body">
                                    <h4><?= t('Add Content To Package') ?></h4>
                                    <div id="more-contents">
                                        <?php foreach ($model->placeContents as $onePlaceContent){
                                            echo $this->render('new-contents',[
                                                'model' => $onePlaceContent,
                                                'id' =>$onePlaceContent->id,
                                            ]);
                                        }
                                        ?>
                                    </div>
                                    <?= Html::button('<i class="fa fa-plus-circle"></i>', [
                                        'class' => 'add-new-content btn btn-sm btn-success',
                                        'value' => Yii::$app->urlManager->createUrl("/place/add-new-content")]);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <div class="form-group">
                    <?= Html::submitButton(t('Save'), ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>

<?php
$this->registerJsFile('@web/js/custom/place_form.js', ['depends' => [yii\web\JqueryAsset::className()]]);
?>