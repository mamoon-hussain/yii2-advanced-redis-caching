<?php

use webvimark\modules\UserManagement\UserManagementModule;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\forms\ChangeOwnPasswordForm $model
 */

$this->title = t( 'Change own password');
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

                        <?php $form = ActiveForm::begin([
                            'id'=>'user',
//                        'layout'=>'horizontal',
                            'validateOnBlur'=>false,
                            'fieldConfig' => [
                                'template' => "{input}\n{error}",
                            ],
                        ]); ?>

                        <?php if ( $model->scenario != 'restoreViaPhone' ){ ?>
                            <?= $form->field($model, 'current_password')->passwordInput(['maxlength' => 255, 'autocomplete'=>'off']) ?>
                        <?php } else { ?>
                            <?php
                            echo $form->field($model, 'phone', [
                                'template' => '
                {label}
                <div class="form-group">
                {input}
                </div>
                {error}'])->widget(\borales\extensions\phoneInput\PhoneInput::className(), [
                                'jsOptions' => [
                                    'excludeCountries' => ['il'],
//                    'preferredCountries' => ['no', 'pl', 'ua'],
//            'onlyCountries' => ['sy',],
                                ]
                            ]);
                            ?>

                            <?=
                            $form->field($model, 'code')
                                ->textInput(['placeholder' => t('Code'), 'autocomplete' => 'off'])
                            ?>
                        <?php } ?>

                        <?=
                        $form->field($model, 'password')
                            ->textInput(['placeholder' => t('Password'), 'autocomplete' => 'off'])
                        ?>

                        <?=
                        $form->field($model, 'repeat_password')
                            ->textInput(['placeholder' => t('Repeat Password'), 'autocomplete' => 'off'])
                        ?>


                        <!--                        <button type="submit" class="btn btn-default">Login</button>-->
                        <div class="form-group">
                            <?=
                            Html::submitButton(
                                t('Save'), //t( 'Login'),
                                ['class' => 'btn btn-lg btn-primary btn-block']
                            )
                            ?>
                        </div>
                        <br>
                        <div class="social-auth-links text-center" style="margin-top: 25px">
                            <p><?= t('- OR -') ?></p>
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

