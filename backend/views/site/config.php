<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "Configurations";
setViewParam('liActive', 'config');
setViewParam('liinActive', 'config');
?>
<div class="">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (Yii::$app->session->hasFlash('flash_error')): ?>
        <div class="alert alert-danger" role="alert">
            <?= Yii::$app->session->getFlash('flash_error'); ?>
        </div>
    <?php endif; ?>
    <?php if (Yii::$app->session->hasFlash('flash_warning')): ?>
        <div class="alert alert-warning" role="warning">
            <?= Yii::$app->session->getFlash('flash_warning'); ?>
        </div>
    <?php endif; ?>
    <?php if (Yii::$app->session->hasFlash('flash_success')): ?>
        <div class="alert alert-success" role="alert">
            <?= Yii::$app->session->getFlash('flash_success'); ?>
        </div>
    <?php endif; ?>
    <div class="">

        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group field-product-sku required">
                    <label class="control-label" for="product-sku">Contact Email</label>
                    <input type="text" class="form-control" name="config[contact_email]" value="<?= $contact->email ?>" maxlength="150" aria-required="true" aria-invalid="false">
                    <div class="help-block"></div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>