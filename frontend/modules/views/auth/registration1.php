

<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers;
?>
<header>
    <div class="" style="padding: 0 5%;">
        <div class="mx-auto text-center">
            <h1 class="mx-auto my-0 text-uppercase">PAINTER</h1>
            <h2 class="text-white-50 mx-auto mt-2 mb-5">SLOGAN</h2>
        </div>
    </div>
</header>

<section id="form" ><!--form-->
    <section class="projects-section bg-light" id="projects">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="signup-form"><!--sign up form-->
                        <h2>New User Signup!</h2>
                        <!--                        <input type="text" placeholder="Name"/>-->
                        <?php $form = ActiveForm::begin(
                            [

                                'action' => Yii::$app->urlManager->createUrl("/user/auth/registration"),

                            ]
                        ); ?>
                        <?= $form->field($rmodel, 'username')->textInput() ->label('Name') ?>
                        <?= $form->field($rmodel, 'email')->textInput() ?>
                        <?= $form->field($rmodel, 'password')->passwordInput() ?>
                        <div class="form-group">
                            <?= Html::submitButton('submit',
                                ['class' => 'btn btn-primary']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                        <!--                        <input type="email" placeholder="Email Address"/>-->
                        <!--                        <input type="password" placeholder="Password"/>-->

                    </div><!--/sign up form-->
                </div>
            </div>
            </div>
        </div>
    </section><!--/form-->
</section>









