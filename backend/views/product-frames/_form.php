<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Product;
use kartik\select2\Select2;
use common\enums\ActiveInactiveStatus;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\ProductFrames */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-frames-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php
    echo $form->field($model, 'product_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Product::find()->andWhere(['status' => ActiveInactiveStatus::active])->all(), 'id', 'name'),
        'options' => [
            'class' => 'product_select',
            'placeholder' => t('Select'),
        ],
    ]);
    ?>


    <?php
    if($model->isNewRecord) {
        echo $form->field($model, 'imagesFile')->widget(
            FileInput::classname(),
            [
                'options' =>['accept' => 'image/*'],
            ]

        );
    } else {
        echo $form->field($model, 'imagesFile')->widget(
            FileInput::classname(),
            [
                'options' =>['accept' => 'image/*'],
                'pluginOptions' => [
                    'initialPreview' =>[
                        '<img class="img_form" src="'.$model->imageUrl.'" >',
                    ],

                    'initialPreviewAsDate' =>true,
                    'overwriteInitial' => false,
                ],
            ]

        );
    }
    ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
