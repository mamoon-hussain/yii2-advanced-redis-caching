<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model common\models\CommonQuestion */
/* @var $form yii\widgets\ActiveForm */

setViewParam('liActive', 'common-question');
?>

<div class="common-question-form">
    <div class="panel panel-default">
        <div class="panel-body">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'question')->textInput()?>

            <?= $form->field($model, 'answer')->textInput()?>


            <div class="form-group">
                <?= Html::submitButton(t('Save'), ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
