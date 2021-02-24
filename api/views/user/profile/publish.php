<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\enums\PublishEnum;
use common\models\Warehouse;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

$can_change = true;
if(isset($model->is_published) && (user()->type != \common\enums\AdminType::admin)){
    if($model->is_published == PublishEnum::unpublished_by_admin){
        $can_change = false;
    }
}
?>

<div class="modal-header">
    <h5 class="modal-title"><?= $title ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
<?php $form = ActiveForm::begin(); ?>
<div class="modal-body">
    <?php if(!$can_change){ ?>
        <div class="form-group" style="margin: 0;">
            <label class="control-label" for="containerinventory-inventory"><?= t('This action is done by system admin!') ?></label>
            <div class="help-block"></div>
        </div>
    <?php } else { ?>
        <div class="form-group" style="margin: 0;">
            <label class="control-label" for="containerinventory-inventory"><?= t('Are You Sure?') ?></label>
            <input style="display: none;" name="status" value="<?= $newStatus ?>">
            <div class="help-block"></div>
        </div>
    <?php }?>



</div>
<div class="modal-footer">
    <?php if($can_change){ ?>
        <?= Html::submitButton(t('Yes'), ['class' => 'btn btn-success']) ?>
    <?php }?>
    <button type="button" class="btn btn-danger" data-dismiss="modal"><?= t('No') ?></button>
</div>
<?php ActiveForm::end(); ?>







