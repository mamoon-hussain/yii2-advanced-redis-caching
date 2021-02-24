<?php

use webvimark\modules\UserManagement\UserManagementModule;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\forms\ChangeOwnPasswordForm $model
 */

$this->title = t('all', 'Change own password');
?>

<p class="login-box-msg"><?= $this->title ?></p>

<?php $form = ActiveForm::begin([
    'id'=>'user',
//                        'layout'=>'horizontal',
    'validateOnBlur'=>false,
    'fieldConfig' => [
        'template' => "{input}\n{error}",
    ],
]); ?>

<?php if ( $model->scenario != 'restoreViaEmail' ): ?>
    <?= $form->field($model, 'current_password')->passwordInput(['maxlength' => 255, 'autocomplete'=>'off']) ?>

<?php endif; ?>

<?=
$form->field($model, 'password')
    ->textInput(['placeholder' => t('Password'), 'autocomplete' => 'off'])
?>

<?=
$form->field($model, 'repeat_password')
    ->textInput(['placeholder' => t('Repeat Password'), 'autocomplete' => 'off'])
?>


<?=
Html::submitButton(
    '<span class="glyphicon glyphicon-ok"></span> ' . t('Save'), //t( 'Register'),
    ['class' => 'btn btn-primary btn-block']
)
?>


<?php ActiveForm::end(); ?>

<br>
<div class="social-auth-links text-center">
    <p><?= t('- OR -') ?></p>
    <a href="<?= Yii::$app->urlManager->createUrl("/user/auth/registration") ?>" class="btn btn-block btn-social btn-facebook btn-flat">
        <i class="fa fa-plus-circle"></i><?= t('Register') ?>
    </a>
</div>


