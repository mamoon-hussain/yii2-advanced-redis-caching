<?php

use webvimark\modules\UserManagement\UserManagementModule;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\User $user
 */

$this->title = t( t('E-mail confirmation failed'));
?>
<section class="ftco-section bg-light ftco-no-pt" style="padding-top: 4% !important;">
    <div class="container">
        <div class="row justify-content-center pb-5 mb-3">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <h2><?= t('Authorization') ?></h2>
            </div>
        </div>
        <div class="registration-wait-for-confirmation">
            <div class="alert alert-warning text-center">
                <?= $text ?>
            </div>
        </div>

        <br>
        <div class="social-auth-links text-center">
            <a href="<?= Yii::$app->urlManager->createUrl("/user/auth/registration") ?>" class="btn btn-block btn-social btn-facebook btn-flat">
                <i class="fa fa-plus-circle"></i><?= t('Register a new membership') ?>
            </a>
        </div>
    </div>
</section>


