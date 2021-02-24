<?php

use webvimark\modules\UserManagement\UserManagementModule;
use yii\authclient\widgets\AuthChoice;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\User $user
 */

$this->title = t('Registration - confirm your phone number');

$direction = 'ltr';
$float = 'left';
if(Yii::$app->language == 'ar'){
    $direction = 'rtl';
    $float = 'right';
}
?>
<section class="header10 cid-si3gh69yvp mbr-fullscreen" id="header10-7" style="background-image: url('<?= imageUrl('/mbr-1920x1281.jpg') ?>');">
    <div class="align-center container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-9">
                <h1 class="mbr-section-title mbr-fonts-style mb-3 display-1"><strong><?= $this->title ?></strong></h1>
            </div>
        </div>
    </div>
</section>
<div class="" style="padding: 0 5%;margin-top:50px">
    <div class="mx-auto " style="    margin-bottom: 25px">

        <div class="container" >

            <div class="row">

                <div style="width: 100%;">
                    <h3 class="login-class" style="margin-bottom: 15px; text-align: center; direction: <?= $direction ?>;">
                        <?= t('we sent you confirmation code. Please check your sms to verify your account')?>
                    </h3>
                    <a href="<?= Yii::$app->urlManager->createUrl("/user/auth/confirm-phone") ?>" class="recovery-password btn btn-lg btn-primary btn-block">
                        <i class="fa fa-plus-circle"></i><?= t('Verify Account') ?>
                    </a>

                    <br>
                    <div class="social-auth-links text-center">
                        <p style="color: #ffffff"><?= t('- OR -') ?></p>
                        <a href="<?= Yii::$app->urlManager->createUrl("/user/auth/registration") ?>" class="recovery-password btn btn-lg btn-primary btn-block">
                            <i class="fa fa-plus-circle"></i><?= t('Register a new membership') ?>
                        </a>
                    </div>
                    <!-- /.social-auth-links -->
                </div>

            </div>

        </div>
    </div>
</div>






