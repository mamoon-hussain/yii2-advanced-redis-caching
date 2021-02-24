<?php

use webvimark\modules\UserManagement\UserManagementModule;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\forms\PasswordRecoveryForm $model
 */

$this->title = UserManagementModule::t('front', 'Password recovery');
?>

<p class="login-box-msg"><?= $this->title ?></p>

<?php $form = ActiveForm::begin([
    'id'=>'user',
    'options' => ['autocomplete' => 'off'],
    'validateOnBlur' => false,
    'fieldConfig' => [
        'template' => "{input}\n{error}",
    ],
]); ?>

<?=
$form->field($model, 'email')
    ->textInput(['placeholder' => t('Email'), 'autocomplete' => 'off'])
?>

<?=
$form->field($model, 'captcha')->widget(Captcha::className(), [
    'template' => '<div class="" style="text-align: center;">{image}{input}',
    'captchaAction' => ['/user/auth/captcha']
])
?>

<div style="padding: 0 20%;">
    <?=
    Html::submitButton(
        t('Recover'), //UserManagementModule::t('front', 'Login'),
        ['class' => 'btn btn-primary btn-block']
    )
    ?>
</div>

<?php ActiveForm::end(); ?>

<br>
<div class="social-auth-links text-center">
    <p><?= t('- OR -') ?></p>
    <a href="<?= Yii::$app->urlManager->createUrl("/user/auth/login") ?>" class="btn btn-block btn-social btn-facebook btn-flat">
        <i class="fa fa-check-circle"></i><?= t('Login') ?>
    </a>
    <a href="<?= Yii::$app->urlManager->createUrl("/user/auth/registration") ?>" class="btn btn-block btn-social btn-facebook btn-flat">
        <i class="fa fa-plus-circle"></i><?= t('Register') ?>
    </a>
</div>



