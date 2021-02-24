<?php

use webvimark\modules\UserManagement\UserManagementModule;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 */

$this->title = t('Change own password');
?>

<section class="header10 cid-si3gh69yvp mbr-fullscreen" id="header10-7" style="background-image: url('<?= imageUrl('/mbr-1920x1281.jpg') ?>');">
    <div class="align-center container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-9">
                <h1 class="mbr-section-title mbr-fonts-style mb-3 display-1"><strong><?= $this->title; ?></strong></h1>
            </div>
        </div>
    </div>
</section>

<div class="" style="padding: 0 5%;margin-top:50px">
    <div class="mx-auto " style=" margin-bottom: 25px">

        <div class="container" >

            <div class="row">

                <div class="col-lg-12 mx-auto" style="    background-color: beige;">
                    <h1 class="login-class" style="margin-bottom: 15px; text-align: center"><?=t('Change password') ?></h1>
                    <div class="login-form"><!--login form-->


                        <div class="social-auth-links text-center" style="margin-top: 25px">
                            <div class="alert alert-info text-center">
                                <?= t('Password has been changed') ?>
                            </div>
                            <a href="<?= Yii::$app->urlManager->createUrl("/") ?>" class="btn btn-block btn-primary">
                                <i class="fa fa-check-circle"></i><?= t('Continue') ?>
                            </a>
                        </div>
                    </div><!--/login form-->
                </div>
            </div>

        </div>


    </div>
</div>
<style>
    .iti {
        position: relative;
        display: inline-block;
        width: 100%;
    }
</style>






