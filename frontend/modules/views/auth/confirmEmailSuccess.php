<?php

use webvimark\modules\UserManagement\UserManagementModule;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\User $user
 */

$this->title = t( 'E-mail confirmed');
?>

<section class="ftco-section bg-light ftco-no-pt" style="padding-top: 4% !important;">
    <div class="container">
        <div class="row justify-content-center pb-5 mb-3">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <h2><?= t('Authorization') ?></h2>
            </div>
        </div>
        <div class="alert alert-info text-center">
            <?= t( 'E-mail confirmed') ?> - <b><?= $user->email ?></b>
        </div>
        <a href="<?= Yii::$app->urlManager->createUrl("/") ?>" class="btn btn-block btn-social btn-facebook btn-flat">
            <i class="fa fa-check-circle"></i><?= t('Continue') ?>
        </a>
    </div>
</section>



