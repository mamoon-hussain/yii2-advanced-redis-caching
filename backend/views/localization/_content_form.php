<?php

use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\enums\ActiveInactiveStatus;

$dir = 'rtl';
if ($name != 'ar') {
    $dir = 'ltr';
}
?>

<div class="card" id="<?= $name.'_contents_'.$id ?>" style="margin: 0;">
    <div class="card-content">
        <div class="card-body">
            <input class="hidden" name="<?= $name ?>_contents[<?= $id ?>][id]" value="<?= $model->id ?>">
            <div class="row">
                <div id="<?= $name ?>_contents_text_<?= $id ?>" class="col-md-12">
                    <div class="form-group required">
                        <input type="text" id="<?= $name ?>_contents[<?= $id ?>][content]" class="form-control" name="<?= $name ?>_contents[<?= $id ?>][content]"
                               placeholder="<?= Yii::t('all', 'Content', [], $name) ?>" aria-required="true" value="<?= $model->getDescription($name) ?>">
                        <div class="help-block"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

