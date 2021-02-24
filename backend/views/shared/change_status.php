<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

if(!isset($head_bg)){
    $head_bg = 'bg-info';
}
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span></button>
    <h4 class="modal-title"><?= $title ?></h4>
</div>
<?php $form = ActiveForm::begin(); ?>
<div class="modal-body">
    <div class="form-group" style="margin: 0;">
        <?php if(isset($text)){ ?>
            <p><?= $text ?></p>
        <?php } ?>
        <label class="control-label" for="containerinventory-inventory"><?= \Yii::t('all', 'Are You Sure?') ?></label>
        <input style="display: none;" name="status" value="<?= $status ?>">
        <div class="help-block"></div>
    </div>
</div>
<div class="modal-footer">
    <?= Html::submitButton(\Yii::t('all', 'Yes'), ['class' => 'btn btn-success']) ?>
    <button type="button" class="btn btn-warning" data-dismiss="modal"><?= \Yii::t('all', 'No') ?></button>

</div>
<?php ActiveForm::end(); ?>







