<?php

use webvimark\modules\UserManagement\UserManagementModule;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\forms\ChangeOwnPasswordForm $model
 */

$this->title = t( 'Change password');
$this->params['breadcrumbs'][] = $this->title;
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
                    <div class="col-md-12 d-flex" style="background-color: beige;">

                        <div class="change-own-password" style="width: 100%;">


                            <h1 class="lte-hide-title" style="margin-bottom: 15px; text-align: center"><?= $this->title ?></h1>

                            <div class="panel panel-default">
                                <div class="panel-body">

                                    <?php if ( Yii::$app->session->hasFlash('success') ): ?>
                                        <div class="alert alert-success text-center">
                                            <?= Yii::$app->session->getFlash('success') ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="user-form" >

                                        <?php $form = ActiveForm::begin([
                                            'id'=>'user',
                                            'validateOnBlur'=>false,
                                        ]); ?>

                                        <?php if ( $model->scenario != 'restoreViaEmail' ): ?>
                                            <?=
                                            $form->field($model, 'current_password', [
                                                'template' => '{input}
    <span class="glyphicon glyphicon-user form-control-feedback"></span>
    {error}'])
                                                ->textInput(['placeholder' => t('Current'), 'autocomplete' => 'off'])
                                            ?>
                                        <?php endif; ?>


                                        <?=
                                        $form->field($model, 'password', [
                                            'template' => '{input}
    <span class="glyphicon glyphicon-user form-control-feedback"></span>
    {error}'])
                                            ->textInput(['placeholder' => t('Password'), 'autocomplete' => 'off'])
                                        ?>

                                        <?=
                                        $form->field($model, 'repeat_password', [
                                            'template' => '{input}
    <span class="glyphicon glyphicon-user form-control-feedback"></span>
    {error}'])
                                            ->textInput(['placeholder' => t('Repeat Password'), 'autocomplete' => 'off'])
                                        ?>


                                        <div class="form-group">
                                                <?= Html::submitButton(
                                                    '<span class=""></span> ' . t( 'Save'),
                                                    ['class' => 'btn btn-lg btn-secondary btn-block']
                                                ) ?>
                                        </div>

                                        <?php ActiveForm::end(); ?>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>







