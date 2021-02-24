<?php

use webvimark\modules\UserManagement\UserManagementModule;

/**
 * @var yii\web\View $this
 */

$this->title = t( 'Password recovery');
?>
<section class="hero-wrap hero-wrap-2" style="background-image: url('<?= imageUrl('images/web/bg_2.jpg') ?>');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end">
            <div class="col-md-9 ftco-animate pb-5">
                <p class="breadcrumbs mb-2">
                    <span class="mr-2">
                        <a href="<?= Yii::$app->urlManager->createUrl("/") ?>">
                            <?= t('Home') ?> <i class="ion-ios-arrow-forward"></i>
                        </a>
                    </span>
                    <span>
                        <?= t('User') ?> <i class="ion-ios-arrow-forward"></i>
                    </span>
                </p>
                <h1 class="mb-0 bread"><?= $this->title ?></h1>
            </div>
        </div>
    </div>
</section>
<section class="ftco-section ftco-no-pt------- bg-light">
    <div class="container">
        <div class="row d-flex no-gutters">
            <div style="width: 100%;">

                <div class="alert alert-info text-center">
                    <?= t('Check your E-mail for further instructions') ?>
                </div>

                <br>
                <div class="social-auth-links text-center">
                    <p style="color: #ffffff"><?= t('- OR -') ?></p>
                    <a href="<?= Yii::$app->urlManager->createUrl("/user/auth/login") ?>" class="recovery-password btn btn-lg btn-primary btn-block">
                        <i class="fa fa-check-circle"></i><?= t('Sign in') ?>
                    </a>
                    <a href="<?= Yii::$app->urlManager->createUrl("/user/auth/registration") ?>" class="recovery-password btn btn-lg btn-primary btn-block">
                        <i class="fa fa-plus-circle"></i><?= t('Register') ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>


