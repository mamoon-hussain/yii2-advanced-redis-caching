<?php

use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Certificate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="modal-header">
    <h5 class="modal-title"><?= t('Add Images') ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
<?php
$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
?>
<div class="modal-body">

    <?= $form->field($model, 'imagesFiles[]')->widget(FileInput::classname(), ['options' => ['accept' => 'image/*', 'multiple' => true],]); ?>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?= t('Close') ?></button>
    <?= Html::submitButton($model->isNewRecord ? t('Add') : t('Save'), ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>








