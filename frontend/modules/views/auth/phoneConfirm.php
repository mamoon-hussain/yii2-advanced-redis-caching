<?php

use webvimark\modules\UserManagement\UserManagementModule;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\forms\ConfirmMobileForm $model
 */

setViewParam('liActive', 'home');
$this->title = t( 'Confirm Phone number');
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
    <div class="mx-auto " style="     margin-bottom: 25px">

        <div class="container" >
            <div class="row">
                <div class="col-lg-12 mx-auto" style="    background-color: beige;">
                    <div class="login-form"><!--login form-->
                        <h1 class="login-class" style="margin-bottom: 15px; text-align: center"><?=t('Confirm Phone') ?></h1>
                        <?php if (Yii::$app->session->hasFlash('flash_error')): ?>
                            <div class="alert alert-danger" role="alert">
                                <?= Yii::$app->session->getFlash('flash_error'); ?>
                            </div>
                        <?php endif; ?>
                        <?php if (Yii::$app->session->hasFlash('flash_warning')): ?>
                            <div class="alert alert-warning" role="alert">
                                <?= Yii::$app->session->getFlash('flash_warning'); ?>
                            </div>
                        <?php endif; ?>
                        <?php if (Yii::$app->session->hasFlash('flash_success')): ?>
                            <div class="alert alert-success" role="alert">
                                <?= Yii::$app->session->getFlash('flash_success'); ?>
                            </div>
                        <?php endif; ?>
                        <?php $form = ActiveForm::begin([
                            'id'=>'user',
                            'options' => ['autocomplete' => 'off'],
                            'validateOnBlur' => false,
                            'fieldConfig' => [
                                'template' => "{input}\n{error}",
                            ],
                        ]); ?>

                        <?php
                        echo $form->field($model, 'mobile', [
                            'template' => '

                <div class="form-group">
                {input}
                </div>
                {error}'])->widget(\borales\extensions\phoneInput\PhoneInput::className(), [
                            'jsOptions' => [
                                'excludeCountries' => ['il'],
//                    'preferredCountries' => ['no', 'pl', 'ua'],
//                                'onlyCountries' => ['iq',],
                            ]
                        ]);
//                        echo $form->field($model, 'mobile')
//                            ->textInput(['placeholder' => t('Mobile'), 'autocomplete' => 'off'])
                        ?>

                        <?=
                        $form->field($model, 'confirm_code')
                            ->textInput(['placeholder' => t('Code'), 'autocomplete' => 'off'])
                        ?>

                        <div class="form-group">

                            <?=
                            Html::submitButton(
                                t('Confirm'), //t( 'Login'),
                                ['class' => 'btn btn-lg btn-secondary btn-block']
                            )
                            ?>
                        </div>

                        <a class="pull-right" style="float: right;" href="<?= Yii::$app->urlManager->createUrl("/user/auth/registration") ?>">
                            <?= t('Register') ?>
                        </a>
                        <a href="<?= Yii::$app->urlManager->createUrl("/user/auth/login") ?>">
                            <?= t('Login') ?>
                        </a>
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