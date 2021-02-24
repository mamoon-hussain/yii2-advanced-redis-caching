<?php

use webvimark\modules\UserManagement\UserManagementModule;
use yii\authclient\widgets\AuthChoice;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\User $user
 */

$this->title = UserManagementModule::t('front', 'Registration - confirm your e-mail');
?>
<p class="login-box-msg"><?= t(' Authorization') ?></p>

<?php if(isset($text) && $text){ ?>
    <div class="alert alert-warning text-center">
        <?= $text ?>
    </div>
<?php }?>

<div class="alert alert-info text-center">
    <?= UserManagementModule::t('front', 'Check your e-mail {email} for instructions to activate account', [
        'email'=>'<b>'. $user->email .'</b>'
    ]) ?>
</div>
<div style="padding: 0 20%;">
    <a class="btn btn-block btn-primary" href="<?= Yii::$app->urlManager->createUrl("/user-management/auth/resend-activation-email/$user->id") ?>">
        <?= t('Resend Email') ?>
    </a>
</div>
<br>
<div class="social-auth-links text-center">
    <p><?= t('- OR -') ?></p>
    <a href="<?= Yii::$app->urlManager->createUrl("/user-management/auth/registration") ?>" class="btn btn-block btn-social btn-facebook btn-flat">
        <i class="fa fa-plus-circle"></i><?= t('Register a new membership') ?>
    </a>
</div>
<!-- /.social-auth-links -->



