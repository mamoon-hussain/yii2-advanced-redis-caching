<?php

use webvimark\modules\UserManagement\UserManagementModule;

/**
 * @var yii\web\View $this
 */

$this->title = t( 'Password recovery');
?>

<p class="login-box-msg"><?= $this->title ?></p>

<div class="alert alert-info text-center">
    <?= t('Check your E-mail for further instructions') ?>
</div>

<br>
<div class="social-auth-links text-center">
    <a href="<?= Yii::$app->urlManager->createUrl("/user/auth/login") ?>" class="btn btn-block btn-social btn-facebook btn-flat">
        <i class="fa fa-check-circle"></i><?= t('Login') ?>
    </a>
    <a href="<?= Yii::$app->urlManager->createUrl("/user/auth/registration") ?>" class="btn btn-block btn-social btn-facebook btn-flat">
        <i class="fa fa-plus-circle"></i><?= t('Register') ?>
    </a>
</div>


