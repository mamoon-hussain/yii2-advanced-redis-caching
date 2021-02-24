<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\Product;
use common\enums\PaintingToolType;
use common\enums\ActiveInactiveStatus;
use kartik\file\FileInput;
use dosamigos\tinymce\TinyMce;
use common\models\Category;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */

setViewParam('liActive', 'product');

switch ($type) {
    case PaintingToolType::painting:
        setViewParam('liinActive', 'painting');
        break;

    case PaintingToolType::tool:
        setViewParam('liinActive', 'tool');
        break;
}
?>

    <div class="product-form">
        <?php $form = ActiveForm::begin(); ?>
        <div class="panel panel-default">
            <div class="panel-body">

                <?php if ($type == PaintingToolType::painting) { ?>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'name')->textInput() ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'price')->textInput(['type' => 'number', 'step' => '0.1']) ?>
                        </div>
                    </div>
                    <?= $form->field($model, 'small_description')->textInput() ?>
                <?php } else { ?>
                    <div class="row">
                        <div class="col-md-3">
                            <?= $form->field($model, 'name')->textInput() ?>
                        </div>
                        <div class="col-md-3">
                            <?= $form->field($model, 'category_id')->widget(Select2::class, [
                                'data' => ArrayHelper::map(Category::find()
                                    ->andWhere(['status' => ActiveInactiveStatus::active])
                                    ->all(), 'id', 'name'),
                            ]); ?>
                        </div>
                        <div class="col-md-2">
                            <?= $form->field($model, 'price')->textInput(['type' => 'number', 'step' => '0.1']) ?>
                        </div>
                        <div class="col-md-2">
                            <?= $form->field($model, 'has_offer')->checkbox() ?>
                        </div>
                        <?php
                        $old_price_class = 'hidden';
                        if($model->has_offer){
                            $old_price_class = '';
                        }
                        ?>
                        <div class="has_offer_div col-md-2 <?= $old_price_class ?>">
                            <?= $form->field($model, 'old_price')->textInput(['type' => 'number', 'step' => '0.1']) ?>
                        </div>
                    </div>
                <?php } ?>

                <?= $form->field($model, 'description')->widget(TinyMce::className(), [
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
                ]);?>

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
                            'height' => 300, // must be specified // you can set as string '100px'
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



                //                if($model->isNewRecord) {
                //                    echo $form->field($model, 'imagesFile')->widget(
                //                        FileInput::classname(),
                //                        [
                //                            'options' =>['accept' => 'image/*'],
                //                        ]
                //
                //                    );
                //                } else {
                //                    echo $form->field($model, 'imagesFile')->widget(
                //                        FileInput::classname(),
                //                        [
                //                            'options' =>['accept' => 'image/*'],
                //                            'pluginOptions' => [
                //                                'initialPreview' =>[
                //                                    '<img class="img_form" src="'.$model->imageUrl.'" >',
                //                                ],
                //
                //                                'initialPreviewAsDate' =>true,
                //                                'initialPreviewShowDelete' => false,
                //                                'overwriteInitial' => true,
                //                            ],
                //                        ]
                //                    );
                //                }

                if ($type == PaintingToolType::painting) {
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
                                    <h4><?= t('Add Frames') ?></h4>
                                    <div id="preview-images">
                                        <?php foreach ($model->productFrames as $oneImage){
                                            echo $this->render('new-images',[
                                                'model' => $oneImage,
                                                'id' =>$oneImage->id,
                                            ]);
                                        }
                                        ?>
                                    </div>
                                    <?= Html::button('<i class="fa fa-plus-circle"></i>', [
                                        'class' => 'add-new-image btn btn-sm btn-success',
                                        'value' => Yii::$app->urlManager->createUrl("/product/add-new-image")]);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <div class="form-group">
                    <?= Html::submitButton(t('Save'), ['class' => 'btn btn-success']) ?>
                </div>

            </div>
        </div>
        <?php ActiveForm::end(); ?>

    </div>

<?php
$this->registerJsFile('@web/js/custom/place_form.js', ['depends' => [yii\web\JqueryAsset::className()]]);
?>

<style>
    .field-product-has_offer {
         margin-top: 25px;
    }
</style>
