<?php

/**
 * @var $this yii\web\View
 * @var $model webvimark\modules\UserManagement\models\forms\LoginForm
 */
use webvimark\modules\UserManagement\components\GhostHtml;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\authclient\widgets\AuthChoice;
?>

<p class="login-box-msg"><?= t(' Authorization') ?></p>

<?php
$form = ActiveForm::begin([
    'id' => 'login-form',
    'options' => ['autocomplete' => 'off'],
    'validateOnBlur' => false,
    'fieldConfig' => ['options' => ['class' => 'form-group has-feedback']],
])
?>
<?=
$form->field($model, 'email', [
    'template' => '{input}
    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    {error}'])
    ->textInput(['placeholder' => t('Email'), 'autocomplete' => 'off', 'type' => 'email'])->label(false)
?>
<?=
$form->field($model, 'password', [
    'template' => '{input}
    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    {error}'])
    ->passwordInput(['placeholder' => $model->getAttributeLabel('password'), 'autocomplete' => 'off'])
?>


<div class="row">
    <div class="col-xs-8">
        <div class="checkbox icheck">
            <label>
                <a href="<?= Yii::$app->urlManager->createUrl("/user-management/auth/password-recovery") ?>">
                    <?= t('I forgot my password') ?>
                </a>
<!--                <input name="AdminLoginForm[rememberMe]" type="checkbox"> --><?//= t('Remember Me') ?>
            </label>
        </div>
    </div>
    <!-- /.col -->
    <div class="col-xs-4">
        <button type="submit" class="btn btn-primary btn-block btn-flat"><?= t('Sign In') ?></button>
    </div>
    <!-- /.col -->
</div>
<?php ActiveForm::end() ?>


<br>
<div class="social-auth-links text-center">
    <p><?= t('- OR -') ?></p>
    <a href="<?= Yii::$app->urlManager->createUrl("/user-management/auth/registration") ?>" class="btn btn-block btn-social btn-facebook btn-flat">
        <i class="fa fa-plus-circle"></i><?= t('Register a new membership') ?>
    </a>
</div>
<!-- /.social-auth-links -->


