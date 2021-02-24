<?php

use webvimark\modules\UserManagement\UserManagementModule;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\User $user
 */

$this->title = UserManagementModule::t('front', t('E-mail confirmation failed'));
?>

<p class="login-box-msg"><?= t(' Authorization') ?></p>

<div class="registration-wait-for-confirmation">
    <div class="alert alert-warning text-center">
        <?= $text ?>
    </div>
</div>

<br>
<div class="social-auth-links text-center">
    <a href="<?= Yii::$app->urlManager->createUrl("/user-management/auth/registration") ?>" class="btn btn-block btn-social btn-facebook btn-flat">
        <i class="fa fa-plus-circle"></i><?= t('Register a new membership') ?>
    </a>
</div>
<!-- /.social-auth-links -->

