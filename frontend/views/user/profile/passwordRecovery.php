<?php

use webvimark\modules\UserManagement\UserManagementModule;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\forms\PasswordRecoveryForm $model
 */
$this->title = t( 'Password recovery');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="password-recovery">

    <h2 class="text-center"><?= $this->title ?></h2>

    <?php if (Yii::$app->session->hasFlash('flash_error')): ?>
        <div class="alert alert-danger" role="alert" style="">
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

    <?php
    $form = ActiveForm::begin([
                'id' => 'user',
                'layout' => 'horizontal',
                'validateOnBlur' => false,
    ]);
    ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 255, 'autofocus' => true]) ?>

    <?=
    $form->field($model, 'captcha')->widget(Captcha::className(), [
        'template' => '<div class="row"><div class="col-sm-4">{image}</div><div class="col-sm-8">{input}</div></div>',
        'options' => [
            'style' => 'text-transform: inherit;',
            'class' => 'form-control'
        ],
        'captchaAction' => ['/user/auth/captcha']
    ])
    ?>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <?=
            Html::submitButton(
                    '<span class="glyphicon glyphicon-ok"></span> ' . t( 'Recover'), ['class' => 'btn btn-primary']
            )
            ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
