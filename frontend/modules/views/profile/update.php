<?php

use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use yii\helpers\Html;

$this->title = t('Profile');

$this->params['breadcrumbs'][] = $this->title;
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
    <div class="mx-auto " style="     margin-bottom: 25px">

        <div class="container" >

            <div class="row">

                <div class="col-lg-12 mx-auto" style="    background-color: beige;">
                    <h1 class="login-class" style="margin-bottom: 15px; text-align: center"><?=t('Update your info') ?></h1>
                    <?php if (Yii::$app->session->hasFlash('flash_error')): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= Yii::$app->session->getFlash('flash_error'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (Yii::$app->session->hasFlash('flash_success')): ?>
                        <div class="alert alert-success" role="alert">
                            <?= Yii::$app->session->getFlash('flash_success'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="login-form"><!--login form-->

                        <div class="row" style="text-align: center;">
                            <div class="col-md-12">
                                <?= Html::a(t('Change Password'), ['change-own-password'], [
                                    'class' => 'btn btn-primary display-4',
                                ]) ?>
                                <a class="btn btn-warning display-4" style=""
                                   href="<?= Yii::$app->urlManager->createUrl("/user/auth/logout") ?>"><?= t('Logout')?>
                                </a>
                            </div>
                        </div>



                        <?php $form = ActiveForm::begin([
                            'id'=>'user',
//                'layout'=>'horizontal',
                            'validateOnBlur' => false,
                        ]); ?>

                        <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'fname')->textInput(['maxlength' => 50, 'autocomplete'=>'off', 'autofocus'=>true]) ?>

                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'lname')->textInput(['maxlength' => 50, 'autocomplete'=>'off', 'autofocus'=>true]) ?>

                        </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <?php


                                echo $form->field($model, 'phone', [
                                    'template' => '

                <div class="form-group">
                {label}
                {input}
                </div>
                {error}'])->widget(\borales\extensions\phoneInput\PhoneInput::className(), [
                                    'jsOptions' => [
                                        'excludeCountries' => ['il'],
//                    'preferredCountries' => ['no', 'pl', 'ua'],
//                                'onlyCountries' => ['iq',],
                                    ]
                                ]);


                                //                       echo $form->field($model, 'phone')
                                //                            ->textInput(['placeholder' => $model->getAttributeLabel('phone'), 'autocomplete' => 'off'])
                                ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

                            </div>
                            </div>





                        <div class="form-group">
                            <?php if ( $model->isNewRecord ): ?>
                                <?= Html::submitButton(
                                    '<span class=""></span> ' . t('Create'),//t('all', 'Create'),
                                    ['class' => 'btn btn-lg btn-primary btn-block']
                                ) ?>
                            <?php else: ?>
                                <?= Html::submitButton(
                                    '<span class=""></span> ' . t('Save'),//t('all', 'Save'),
                                    ['class' => 'btn btn-lg btn-primary btn-block']
                                ) ?>
                            <?php endif; ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<style>
    .field-birth_date > .input-group > .input-group-addon{
        width: 5%;
    }
    .field-birth_date > .input-group > .input-group-addon > .glyphicon {
        margin-top: 10px;
    }
     .select2-container{
         direction: <?= $direction ?>;
         text-align: <?= $float ?>;
     }
    form > .mb-3{
        text-align: <?= $float ?>;
    }
    form{
        direction: <?= $direction ?>;
        text-align: <?= $float ?>;
    }
</style>

<style>
    .iti {
        position: relative;
        display: inline-block;
        width: 100%;
    }
</style>

