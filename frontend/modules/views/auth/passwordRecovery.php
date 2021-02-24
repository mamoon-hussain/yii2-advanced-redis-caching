<?php

use webvimark\modules\UserManagement\UserManagementModule;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\forms\PasswordRecoveryForm $model
 */

setViewParam('liActive', 'home');
$this->title = t( 'Password recovery');
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
    <div class="mx-auto " style="    margin-bottom: 25px">

        <div class="container" >

            <div class="row">

                <div class="col-lg-12 mx-auto" style="    background-color: beige;">
                    <h1 class="login-class" style="margin-bottom: 15px; text-align: center"><?=t('Password Recovery') ?></h1>
                    <div class="login-form"><!--login form-->

                            <?php $form = ActiveForm::begin([
                                'id'=>'user',
                                'options' => ['autocomplete' => 'off'],
                                'validateOnBlur' => false,
                                'fieldConfig' => [
                                    'template' => "{input}\n{error}",
                                ],
                            ]); ?>

                            <?php
                            echo $form->field($model, 'phone', [
                                'template' => '

                <div class="form-group">
                {input}
                </div>
                {error}'])->widget(\borales\extensions\phoneInput\PhoneInput::className(), [
                                'jsOptions' => [
                                    'preferredCountries' => ['kw'],
                                    'excludeCountries' => ['il'],
//                    'preferredCountries' => ['no', 'pl', 'ua'],
//                                'onlyCountries' => ['iq',],
                                ]
                            ]);
//                            echo $form->field($model, 'phone')
//                                ->textInput(['placeholder' => t('phone'), 'autocomplete' => 'off']);
                            ?>

                        <div class="form-group">
                            <?=
                            Html::submitButton(
                                t('Confirm'), //t( 'Login'),
                                ['class' => 'btn btn-lg btn-primary btn-block']
                            )
                            ?>
                        </div>

                            <br>
                            <div class="social-auth-links text-center">
                                <p style="color: #ffffff"><?= t('- OR -') ?></p>
                                <a href="<?= Yii::$app->urlManager->createUrl("/user/auth/login") ?>" class="btn btn-lg btn-primary btn-block">
                                    <i class="fa fa-check-circle"></i><?= t('Login') ?>
                                </a>
                                <a href="<?= Yii::$app->urlManager->createUrl("/user/auth/registration") ?>" class="btn btn-lg btn-primary btn-block">
                                    <i class="fa fa-plus-circle"></i><?= t('Register') ?>
                                </a>
                            </div>
                        <?php ActiveForm::end(); ?>
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
