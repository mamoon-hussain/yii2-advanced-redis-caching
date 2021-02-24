<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Certificate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?= $title ?></h4>
    </div>
    <div class="modal-body">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <?php if ($model->attachment) { ?>
            <?=
            $form->field($model, 'attachmentfile')->widget(FileInput::classname(), ['options' => ['accept' => 'image/*'],
                'pluginOptions' => [
                    'initialPreview' => [
                        Html::img($model->attachmentUrl, ['class' => 'file-preview-image', 'style' => 'height: 200px']),
                    ],
                    'initialCaption' => $model->attachment,
                    'overwriteInitial' => true
                ]
            ]);
            ?>
        <?php } else { ?>
            <?= $form->field($model, 'attachmentfile')->widget(FileInput::classname(), ['options' => ['accept' => 'image/*'],]); ?>
        <?php } ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>






