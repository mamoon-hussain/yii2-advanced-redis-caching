<?php
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
?>

<div class="one-preview-image" id="previewImageContainer<?= $id ?>"  data-id="<?= $id ?>">
    <div class="panel panel-default">
        <div class="panel-body">
            <?php
            if(!$model->isNewRecord){
                echo '<input style="display: none" name="preview['. $id.']" value="'. $model->id.'">';
                $defaultImage = $model->imageUrl;
            } else {
                $defaultImage = null;
            }
            echo '<label class="control-label">'. $model->getAttributeLabel(t('image')). '</label>
<a class="delete-preview" style="color: red;cursor: pointer;" data-id="'.$id.'"><i class="fa fa-times"></i></a> ';
            echo \bilginnet\cropper\Cropper::widget([
                'uniqueId' => 'other_image_cropper_'.$id, // will create automaticaly if not set
                'name' => 'imagesFile['.$id.']',
                'id' =>'imagesFile'.$id,
                'cropperOptions' => [
                    'width' => 400, // must be specified
                    'height' => 280, // must be specified
                    'preview' => [
                        'url' => $defaultImage, // (!empty($model->image)) ? Yii::getAlias('@uploadUrl/'.$model->image) : null
                        'width' => 400, // must be specified // you can set as string '100%'
                        'height' => 280, // must be specified // you can set as string '100px'
                    ],
                    'buttonCssClass' => 'btn btn-primary',
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
                'label' => $model->getAttributeLabel('image'),
                'template' => '{button}{preview}',
            ]);














//            if($model->isNewRecord) {
//
//                echo '<label class="control-label">'. $model->getAttributeLabel(t('Frame')). '</label>
//<a class="delete-preview" style="color: red;cursor: pointer;" data-id="'.$id.'"><i class="fa fa-times"></i></a> ';
//                echo FileInput::widget([
//                    'id' =>'imagesFile'.$id,
//                    'name' => 'imagesFile['.$id.']',
//                    'options' =>['accept' => 'image/*']
//                ]);
//            } else {
//                echo '<input style="display: none" name="preview['. $id.']" value="'. $model->id.'">';
//                echo '<label class="control-label">'. $model->getAttributeLabel(t('Frame')). '</label>
//<a class="delete-preview" style="color: red;cursor: pointer;" data-id="'.$id.'"><i class="fa fa-times"></i></a>  ';
//
//                echo FileInput::widget([
//                    'id' =>'imagesFile'.$id,
//                    'name' => 'imagesFile['.$id.']',
//                    'options' =>['accept' => 'image/*'],
//                    'pluginOptions' => [
//                        'initialPreview' =>[
//                            '<img class="img_form" src="'.$model->imageUrl.'" >',
//                        ],
//                        'initialPreviewAsDate' =>true,
//                        'overwriteInitial' => false,
//                    ],
//                ]);
//            }
            ?>
        </div>
    </div>
</div>
