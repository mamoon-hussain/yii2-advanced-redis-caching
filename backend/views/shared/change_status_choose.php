<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

$dir = 'rtl';
if(Yii::$app->language != 'ar'){
    $dir = 'ltr';
}
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span></button>
    <h4 class="modal-title"><?= $title ?></h4>
</div>
<?php $form = ActiveForm::begin(); ?>
<div class="modal-body">
    <?=
    $form->field($model, 'status')->widget(Select2::classname(), [
        'data' => $status_list,
        'options' => [
            'placeholder' => \Yii::t('all', 'Select...'),
            'dir' => $dir,
        ],
        'pluginOptions' => [
            'dir' => $dir,
        ],
    ]);
    ?>
</div>
<div class="modal-footer">
    <?= Html::submitButton(\Yii::t('all', 'Save'), ['class' => 'btn btn-outline-info waves-effect waves-light']) ?>
    <button type="button" class="btn grey btn-outline-secondary waves-effect waves-light" data-dismiss="modal">
        <?= \Yii::t('all', 'Close') ?>
    </button>
</div>
<?php ActiveForm::end(); ?>






