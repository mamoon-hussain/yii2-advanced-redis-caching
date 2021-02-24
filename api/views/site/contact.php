<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \api\models\ContactForm */

setViewParam('liActive', 'support');
$this->title = t('Contact us');
$this->params['breadcrumbs'][] = $this->title;
$Maintitle = t(Yii::$app->params['title']);
?>
<div class="breadcrumb-area bg--white-6 pt--60 pb--70 pt-lg--40 pb-lg--50 pt-md--30 pb-md--40">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1 class="page-title"><?= $this->title ?></h1>
                        <ul class="breadcrumb justify-content-center">
                            <li><a href="<?= Yii::$app->urlManager->createUrl("/site/index") ?>"> <?= $Maintitle; ?></a></li>
                            <li class="current"><span><?= $this->title ?></span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
<div class="site-contact">
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-body">

                <br/>
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

                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'name')->textInput() ?>

                <?= $form->field($model, 'email')->textInput() ?>

                <?= $form->field($model, 'subject')->textInput() ?>

                <?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>

                <?php
//                $form->field($model, 'verifyCode')->widget(Captcha::className(), [
//                    'template' => '<div class="row"><div class="col-lg-12">{image}</div><div class="col-lg-12">{input}</div></div>',
//                ])
                ?>
                <div class="form-group">
                    <?= Html::submitButton(t('Send'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>

        </div>
    </div>
</div>
