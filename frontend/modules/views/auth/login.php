
<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers;
use borales\extensions\phoneInput\PhoneInput;

/* @var $this yii\web\View */

$this->title = t('Login');

setViewParam('liActive', 'home');
$this->title = t(Yii::$app->params['title']);
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
                    <h1 class="login-class" style="margin-bottom: 15px; text-align: center"><?=t('Login') ?></h1>
                    <div class="login-form"><!--login form-->

                        <!--                            --><?php //$form = ActiveForm::begin(
                        //                                [
                        //                                    'action' => Yii::$app->urlManager->createUrl("/user/auth/login"),
                        //                                ]
                        //                            ); ?>
                        <?php
                        $form = ActiveForm::begin([
                            'id' => 'login-form',
                            'options' => ['autocomplete' => 'off'],
                            'validateOnBlur' => false,
                            'fieldConfig' => [
                                'template' => "{input}\n{error}",
                            ],
                        ]);
                        ?>
                        <!--                        <input type="text" placeholder="Name" />-->
                        <!--                        <input type="email" placeholder="Email Address" />-->
                        <?php


//                        echo $form->field($model, 'phone', [
//                            'template' => '
//
//                <div class="form-group">
//                {input}
//                </div>
//                {error}'])->widget(PhoneInput::className(), [
//                            'jsOptions' => [
//                                'preferredCountries' => ['kw'],
//                                    'excludeCountries' => ['il'],
////                    'preferredCountries' => ['no', 'pl', 'ua'],
////                                'onlyCountries' => ['iq',],
//                            ]
//                        ]);


                       echo $form->field($model, 'email')
                            ->textInput(['placeholder' => $model->getAttributeLabel('email'), 'autocomplete' => 'off'])
                        ?>

                        <?=
                        $form->field($model, 'password')
                            ->passwordInput(['placeholder' => $model->getAttributeLabel('password'), 'autocomplete' => 'off'])
                        ?>
                        <label style=" margin-bottom: -1.5rem;">
                            <?= $form->field($model, 'rememberMe')->checkbox(['value' => true]) ?>
                        </label>


                        <!--                        <button type="submit" class="btn btn-default">Login</button>-->
                        <div class="form-group">
                            <?=
                            Html::submitButton(
                                t('Login'), //t( 'Login'),
                                ['class' => 'btn btn-lg btn-primary btn-block']
                            )
                            ?>
                        </div>
                        <a href="<?= Yii::$app->urlManager->createUrl("/user/auth/password-recovery") ?>">
                            <?= t('Forget Password?') ?>
                        </a>
                        <a class="pull-right" style="float: right;" href="<?= Yii::$app->urlManager->createUrl("/user/auth/registration") ?>">
                            <?= t('Register') ?>
                        </a>
                        <br>
                        <a href="<?= Yii::$app->urlManager->createUrl("/user/auth/confirm-phone") ?>">
                            <?= t('Confirm account') ?>
                        </a>
                        <?php ActiveForm::end(); ?>
                    </div><!--/login form-->
                </div>
            </div>

        </div>


    </div>
</div>
