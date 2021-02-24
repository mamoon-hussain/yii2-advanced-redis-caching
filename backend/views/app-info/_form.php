<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\enums\ActiveInactiveStatus;
use common\models\State;
use common\models\City;
use borales\extensions\phoneInput\PhoneInput;
use kartik\file\FileInput;

$dir = 'rtl';
if(Yii::$app->language != 'ar'){
    $dir = 'ltr';
}
setViewParam('liActive', 'app-info');
?>


<?php $form = ActiveForm::begin(); ?>
    <div class="panel panel-default">
    <div class="panel-body">

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?php
            echo $form->field($model, 'phone', [
                'template' => '
                {label}
                <div class="form-group">
                {input}
                </div>
                {error}'])->widget(PhoneInput::className(), [
                'jsOptions' => [
//                    'preferredCountries' => ['no', 'pl', 'ua'],
                    'onlyCountries' => ['iq',],
                ]
            ]);
            ?>
            <?php //$form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?php
            echo $form->field($model, 'mobile', [
                'template' => '
                {label}
                <div class="form-group">
                {input}
                </div>
                {error}'])->widget(PhoneInput::className(), [
                'jsOptions' => [
//                    'preferredCountries' => ['no', 'pl', 'ua'],
                    'onlyCountries' => ['iq',],
                ]
            ]);
            ?>
            <?php //$form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

        <?php
        echo  $form->field($model, 'home_description')->widget(\dosamigos\tinymce\TinyMce::className(), [
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
        echo  $form->field($model, 'description')->widget(\dosamigos\tinymce\TinyMce::className(), [
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


<?= $form->field($model, 'site_url')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'facebook_url')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'instagram_url')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'youtube_url')->textInput(['maxlength' => true]) ?>

        <?php
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
                    'width' => '100%', // must be specified // you can set as string '100%'
                    'height' => '100%', // must be specified // you can set as string '100px'
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

<?php //echo $form->field($model, 'linkedin_url')->textInput(['maxlength' => true]) ?>

<?php //echo $form->field($model, 'twitter_url')->textInput(['maxlength' => true]) ?>

<div class="form-group">
    <?= Html::submitButton(t('Save'), ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>
    </div>
    </div>

<style>
    .iti {
        width: 100%;
        direction: ltr;
    }
</style>
<?php $this->registerJsFile('@web/js/custom/location.js', ['depends' => [yii\web\JqueryAsset::className()]]); ?>