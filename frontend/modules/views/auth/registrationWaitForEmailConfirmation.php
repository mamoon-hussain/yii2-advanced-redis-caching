<?php

use webvimark\modules\UserManagement\UserManagementModule;
use yii\authclient\widgets\AuthChoice;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\User $user
 */

$this->title = t('Registration - confirm your e-mail');
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

                <?php if(isset($text) && $text){ ?>
                    <div class="alert alert-warning text-center">
                        <?= $text ?>
                    </div>
                <?php }?>

                <div class="alert alert-info text-center">
                    <?= t('Check your e-mail {email} for instructions to activate account', [
                        'email'=>'<b>'. $user->email .'</b>'
                    ]) ?>
                </div>
<!--                <div style="padding: 0 20%;">-->
<!--                    <a class="btn btn-block btn-primary" href="--><?php //echo Yii::$app->urlManager->createUrl("/user/auth/resend-activation-email/$user->id") ?><!--">-->
                            <?php //echo t('Resend Email') ?>
<!--                    </a>-->
<!--                </div>-->
                <br>
                <div class="social-auth-links text-center">
                    <p><?= t('- OR -') ?></p>
                    <a href="<?= Yii::$app->urlManager->createUrl("/user/auth/registration") ?>" class="btn btn-block btn-social btn-facebook btn-flat">
                        <i class="fa fa-plus-circle"></i><?= t('Register a new membership') ?>
                    </a>
                </div>
                <!-- /.social-auth-links -->
            </div>
        </div>
    </div>
</section>



