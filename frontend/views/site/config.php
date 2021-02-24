<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

$this->title = 'Config';
setViewParam('liActive', 5);
?>

<div class="site-contact">
    <h2><?= Html::encode($this->title) ?></h2>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-body">

                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'email')->textInput()->label('Contact Email') ?>

                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>

        </div>
    </div>
</div>
