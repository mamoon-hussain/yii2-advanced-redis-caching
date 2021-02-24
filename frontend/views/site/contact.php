<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

setViewParam('liActive', 'support');
$this->title = t('Contact us');
$this->params['breadcrumbs'][] = $this->title;
$Maintitle = t(Yii::$app->params['title']);
?>


<section class="hero-wrap hero-wrap-2" style="background-image: url('<?= imageUrl('images/web/bg_1.jpg') ?>');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end">
            <div class="col-md-9 ftco-animate pb-5">
                <p class="breadcrumbs mb-2">
                    <span class="mr-2">
                        <a href="<?= Yii::$app->urlManager->createUrl("/") ?>"> 
                            <?= t('Home') ?> <i class="ion-ios-arrow-forward"></i> 
                        </a>
                    </span>

                </p>
                <h1 class="mb-0 bread"><?= $this->title ?></h1>
            </div>
        </div>
    </div>
</section>



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

                <?=
                $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-12">{image}</div><div class="col-lg-12">{input}</div></div>',
                ])
                ?>
                <div class="form-group">
                    <?= Html::submitButton(t('Send'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>

        </div>
    </div>
</div>
