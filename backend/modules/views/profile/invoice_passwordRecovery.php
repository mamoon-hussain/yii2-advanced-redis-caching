<?php

use webvimark\modules\UserManagement\UserManagementModule;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\forms\PasswordRecoveryForm $model
 */
$this->title = UserManagementModule::t('front', 'Password recovery');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="password-recovery">

    <h2 class="text-center"><?= $this->title ?></h2>


    <?php
    $form = ActiveForm::begin([
                'id' => 'user',
                'layout' => 'horizontal',
                'validateOnBlur' => false,
    ]);
    ?>

    <div class="col-md-2">

    </div>
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-body">
                <p>
                    Please enter and Complete any of the following Emails, The recovery info will be sent there.
                </p>
                <?php if(user()->email){ ?>
                    <p><?= mb_substr(user()->email, 0, 2) . '...@' . $email_arr = explode('@', user()->email)[1] ?></p>
                <?php } ?>
                <?php if(user()->second_email){ ?>
                    <p><?= mb_substr(user()->second_email, 0, 2) . '...@' . $email_arr = explode('@', user()->second_email)[1] ?></p>
                <?php } ?>
                <?php if(user()->third_email){ ?>
                    <p><?= mb_substr(user()->third_email, 0, 2) . '...@' . $email_arr = explode('@', user()->third_email)[1] ?></p>
                <?php } ?>
                <?php if(user()->fourth_email){ ?>
                    <p><?= mb_substr(user()->fourth_email, 0, 2) . '...@' . $email_arr = explode('@', user()->fourth_email)[1] ?></p>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="col-md-2">

    </div>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 255, 'autofocus' => true]) ?>

    <?=
    $form->field($model, 'captcha')->widget(Captcha::className(), [
        'template' => '<div class="row"><div class="col-sm-4">{image}</div><div class="col-sm-8">{input}</div></div>',
        'options' => [
            'style' => 'text-transform: inherit;',
            'class' => 'form-control'
        ],
        'captchaAction' => ['/user/auth/captcha']
    ])
    ?>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <?=
            Html::submitButton(
                    '<span class="glyphicon glyphicon-ok"></span> ' . UserManagementModule::t('front', 'Recover'), ['class' => 'btn btn-primary']
            )
            ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
