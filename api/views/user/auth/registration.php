<?php

use webvimark\modules\UserManagement\UserManagementModule;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use webvimark\modules\UserManagement\models\rbacDB\AbstractItem;
use webvimark\modules\UserManagement\models\rbacDB\Role;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\forms\RegistrationForm $model
 */
$this->title = t('Registration'); //UserManagementModule::t('front', 'Registration');
$this->params['breadcrumbs'][] = $this->title;
$Maintitle = t(Yii::$app->params['title']);
?>

<p class="login-box-msg"><?= t(' Register a new membership') ?></p>


<?php
$form = ActiveForm::begin([
    'id' => 'register-form',
    'options' => ['autocomplete' => 'off'],
    'validateOnBlur' => false,
    'fieldConfig' => ['options' => ['class' => 'form-group has-feedback']],
])
?>
<?=
$form->field($model, 'username', [
    'template' => '{input}
    <span class="glyphicon glyphicon-user form-control-feedback"></span>
    {error}'])
    ->textInput(['placeholder' => t('Training Center Name'), 'autocomplete' => 'off'])
?>
<?=
$form->field($model, 'email', [
    'template' => '{input}
    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    {error}'])
    ->textInput(['placeholder' => t('Email'), 'autocomplete' => 'off', 'type' => 'email'])->label(false)
?>
<?=
$form->field($model, 'phone', [
    'template' => '{input}
    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
    {error}'])
    ->textInput(['placeholder' => $model->getAttributeLabel('phone'), 'autocomplete' => 'off'])->label(false)
?>
<?=
$form->field($model, 'password', [
    'template' => '{input}
    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    {error}'])
    ->passwordInput(['placeholder' => $model->getAttributeLabel('password'), 'autocomplete' => 'off'])
?>
<?=
$form->field($model, 'repeat_password', [
    'template' => '{input}
    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    {error}'])
    ->passwordInput(['placeholder' => $model->getAttributeLabel('repeat_password'), 'autocomplete' => 'off'])->label(false)
?>

<?=
$form->field($model, 'captcha')->widget(Captcha::className(), [
    'template' => '<div class="" style="text-align: center;">{image}{input}',
    'captchaAction' => ['/user-management/auth/captcha']
])->label(false)
?>


<div class="row">
    <!-- /.col -->
    <div class="col-xs-12">
        <button type="submit" class="btn btn-primary btn-block btn-flat"><?= t('Register') ?></button>
    </div>
    <!-- /.col -->
</div>
<?php ActiveForm::end() ?>

<br>
<div class="social-auth-links text-center">
    <p><?= t('- OR -') ?></p>
    <a href="<?= Yii::$app->urlManager->createUrl("/user-management/auth/login") ?>" class="btn btn-block btn-social btn-facebook btn-flat">
        <i class="fa fa-check-circle"></i><?= t('Sign up with your account') ?>
    </a>
</div>
<!-- /.social-auth-links -->





















