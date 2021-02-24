<?php
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use common\enums\RequestStatus;
?>

    <div class="modal-header">
        <h5 class="modal-title"><?= $title ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
<?php $form = ActiveForm::begin(); ?>
    <div class="modal-body">
        <?=
        $form->field($model, 'status')->widget(Select2::classname(), [
            'data' => RequestStatus::SelectLabels() ,
            'options' => ['placeholder' => t('Select...')],
        ]);
        ?>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success"><?= t('Save') ?></button>
        <button type="button" class="btn btn-warning" data-dismiss="modal"><?= t('Cancel') ?></button>
    </div>
<?php ActiveForm::end(); ?>