<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers;
use dosamigos\datepicker\DatePicker;
use borales\extensions\phoneInput\PhoneInput;

setViewParam('liActive', 'home');
$this->title = t(Yii::$app->params['title']);
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
    <div class="mx-auto " style=" margin-bottom: 25px">

        <div class="container" >

            <div class="row">

                <div class="col-lg-12 mx-auto" style="    background-color: beige;">
                    <div class="signup-form"><!--sign up form-->
                        <h1 class="login-class" style="margin-bottom: 15px; text-align: center"><?= t('Signup') ?></h1>

                        <?php
                        $form = ActiveForm::begin([
                            'id' => 'register-form',
                            'options' => ['autocomplete' => 'off'],
                            'validateOnBlur' => false,
                            'fieldConfig' => ['options' => ['class' => 'form-group has-feedback']],
                        ])
                        ?>

                        <?=
                        $form->field($model, 'fname', [
                            'template' => '{input}
    <span class="glyphicon glyphicon-user form-control-feedback"></span>
    {error}'])
                            ->textInput(['placeholder' => t('First Name'), 'autocomplete' => 'off'])
                        ?>
                        <?=
                        $form->field($model, 'lname', [
                            'template' => '{input}
    <span class="glyphicon glyphicon-user form-control-feedback"></span>
    {error}'])
                            ->textInput(['placeholder' => t('Last Name'), 'autocomplete' => 'off'])
                        ?>
                        <?=
                        $form->field($model, 'email', [
                            'template' => '{input}
    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    {error}'])
                            ->textInput(['placeholder' => t('Email'), 'autocomplete' => 'off', 'type' => 'email'])->label(false)
                        ?>
                        <?php
                        echo $form->field($model, 'phone', [
                            'template' => '

                <div class="form-group">
                {input}
                </div>
                {error}'])->widget(PhoneInput::className(), [
                            'jsOptions' => [
                                'preferredCountries' => ['kw'],
                                'excludeCountries' => ['il'],
//                    'preferredCountries' => ['no', 'pl', 'ua'],
//                                'onlyCountries' => ['iq',],
                            ]
                        ]);

//                       echo $form->field($model, 'phone', [
//                            'template' => '{input}
//    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
//    {error}'])
//                            ->textInput(['placeholder' => $model->getAttributeLabel('phone'), 'autocomplete' => 'off'])->label(false)
                        ?>
                        <?=
                        $form->field($model, 'password', [
                            'template' => '{input}
    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    {error}'])
                            ->passwordInput(['placeholder' => $model->getAttributeLabel('password'), 'autocomplete' => 'off'])
                        ?>

                        <?=
                        $form->field($model, 'repeat_password', [
                            'template' => '{input}
    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    {error}'])
                            ->passwordInput(['placeholder' => $model->getAttributeLabel('repeat_password'), 'autocomplete' => 'off'])->label(false)
                        ?>
                        <div class="form-group">
                        <?=
                        Html::submitButton(
                            t('Register'),
                            ['class' => 'btn btn-lg btn-secondary btn-block']
                        ) ?>
                        </div>


                        <?php ActiveForm::end(); ?>
                        <!--                        <input type="email" placeholder="Email Address"/>-->
                        <!--                        <input type="password" placeholder="Password"/>-->
                    </div>
                </div><!--/sign up form-->
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







