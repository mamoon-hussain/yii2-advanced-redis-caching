<?php

use webvimark\modules\UserManagement\UserManagementModule;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\User $user
 */

$this->title = UserManagementModule::t('front', 'E-mail confirmed');
?>

<p class="login-box-msg"><?= t(' Authorization') ?></p>

<div class="alert alert-info text-center">
    <?= UserManagementModule::t('front', 'E-mail confirmed') ?> - <b><?= $user->email ?></b>
</div>

<br>
<div class="social-auth-links text-center">
    <?php if ( isset($_GET['returnUrl']) ): ?>
    <a href="<?= $_GET['returnUrl'] ?>" class="btn btn-block btn-social btn-facebook btn-flat">
        <i class="fa fa-check-circle"></i><?= t('Continue') ?>
    </a>
    <?php endif; ?>
</div>

