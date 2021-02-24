<?php

use webvimark\modules\UserManagement\UserManagementModule;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 */

$this->title = t('all', 'Change own password');
?>


<p class="login-box-msg"><?= $this->title ?></p>

<div class="alert alert-info text-center">
    <?= t('Password has been changed') ?>
</div>

<br>
<div class="social-auth-links text-center">
    <p><?= t('- OR -') ?></p>
    <a href="<?= Yii::$app->urlManager->createUrl("/") ?>" class="btn btn-block btn-social btn-facebook btn-flat">
        <i class="fa fa-check-circle"></i><?= t('Continue') ?>
    </a>
</div>


