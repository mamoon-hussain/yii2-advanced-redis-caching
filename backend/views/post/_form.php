<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \bilginnet\cropper\Cropper;
use common\models\Category;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var common\models\Post $model */
/** @var yii\widgets\ActiveForm $form */

setViewParam('liActive', 'post');
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>


    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(Category::find()->all(), 'id', 'name')) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
        </div>
    </div>


    <?php
    if(!$model->isNewRecord){
        $defaultImage = $model->imageUrl;
    } else {
        $defaultImage = null;
    }
    echo $form->field($model, 'imagesFile')->widget(Cropper::className(), [
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


    <?= $form->field($model, 'video')->textInput(['maxlength' => true]) ?>




    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
