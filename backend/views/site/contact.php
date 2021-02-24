<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

setViewParam('liActive', 'contact');
setViewParam('liinActive', 'contact');
$this->title = 'Contact Us';
?>

<div class="panel panel-default">
    <div class="panel-body">
        <h2><?= Html::encode($this->title) ?></h2>

        <?php if (Yii::$app->session->hasFlash('flash_error')): ?>
            <div class="alert alert-danger" role="alert">
                <?= Yii::$app->session->getFlash('flash_error'); ?>
            </div>
        <?php endif; ?>
        <?php if (Yii::$app->session->hasFlash('flash_warning')): ?>
            <div class="alert alert-warning" role="alert">
                <?= Yii::$app->session->getFlash('flash_warning'); ?>
            </div>
        <?php endif; ?>
        <?php if (Yii::$app->session->hasFlash('flash_success')): ?>
            <div class="alert alert-success" role="alert">
                <?= Yii::$app->session->getFlash('flash_success'); ?>
            </div>
        <?php endif; ?>

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput() ?>

        <?= $form->field($model, 'email')->textInput() ?>

        <?= $form->field($model, 'subject')->textInput() ?>

        <?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>

        <div class="form-group">
            <?= Html::submitButton('Send', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

