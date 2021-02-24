<?php

/**
 * @var $this yii\web\View
 * @var $model webvimark\modules\UserManagement\models\forms\LoginForm
 */
use webvimark\modules\UserManagement\components\GhostHtml;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\authclient\widgets\AuthChoice;

$Maintitle = t(Yii::$app->params['title']);
?>

<div class="container" id="login-wrapper">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h1 style="text-align: center; font-weight: 700;"><?= $Maintitle ?></h1>
            <div class="panel panel-default" style="margin-bottom: 0;">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= $Maintitle.t(' Authorization'); ?></h3>
                </div>
                <div class="panel-body">

                    <?php
                    $form = ActiveForm::begin([
                                'id' => 'login-form',
                                'options' => ['autocomplete' => 'off'],
                                'validateOnBlur' => false,
                                'fieldConfig' => [
                                    'template' => "{input}\n{error}",
                                ],
                            ])
                    ?>

                    <?=
                            $form->field($model, 'email')
                            ->textInput(['placeholder' => $model->getAttributeLabel('username'), 'autocomplete' => 'off'])
                    ?>

                    <?=
                            $form->field($model, 'password')
                            ->passwordInput(['placeholder' => $model->getAttributeLabel('password'), 'autocomplete' => 'off'])
                    ?>

                    <div class="col-md-6">
                        <?= $form->field($model, 'rememberMe')->checkbox(['value' => true]) ?>
                    </div>
                    <div class="col-md-6" style="text-align: right;">
                        <div class="form-group field-adminloginform-rememberme">
                            <div class="checkbox">
                                <a href="<?= Yii::$app->urlManager->createUrl("/user/auth/password-recovery") ?>">
                                    <?= t('Forgot password...') ?>
                                </a>
                            </div>
                        </div>
                    </div>



                    <?=
                    Html::submitButton(
                            t('Login'), //UserManagementModule::t('front', 'Login'),
                            ['class' => 'btn btn-lg btn-primary btn-block']
                    )
                    ?>




                    <?php ActiveForm::end() ?>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= t('Or'); ?></h3>
                </div>
                <div class="panel-body">
                    <a class="btn btn-lg btn-primary btn-block" href="<?= Yii::$app->urlManager->createUrl("/user/auth/registration") ?>">
                        <?= t('Register') ?>
                    </a>
                </div>
            </div>


        </div>
    </div>
</div>
