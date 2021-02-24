<?php

use webvimark\modules\UserManagement\models\User;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use webvimark\extensions\BootstrapSwitch\BootstrapSwitch;
use yii\helpers\ArrayHelper;
use common\models\Center;

$this->title = $title;
/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\User $model
 * @var yii\bootstrap\ActiveForm $form
 */
?>
<?php  echo $this->render('_shared_head'); ?>

<section class="ftco-section ftco-no-pt------- bg-light">
    <div class="container">
        <div class="row d-flex no-gutters">
            <div class="col-md-3 pl-md-5 py-md-5" style="padding-top: 0 !important;">
                <?php  echo $this->render('_shared_menu', [
                    'active' => 'profile'
                ]); ?>
            </div>
            <div class="col-md-9 d-flex">
                <div class="user-form" style="width: 100%;">
                    <div class="panel panel-default">
                        <div class="panel-body">
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

                            <?php $form = ActiveForm::begin([
                            ]); ?>

                            <div class="col-md-12" style="padding: 0;">
                                <div class="" style="float: left; width: 100%; padding: 1%;">
                                    <div class="col-md-2" style="padding-left: 0;float: left">
                                        <?= $form->field($model, 'title')->textInput([
                                            'maxlength' => true
                                        ]) ?>
                                    </div>
                                    <div class="col-md-5" style="float: left">
                                        <?= $form->field($model, 'first_name')->textInput([
                                            'maxlength' => true
                                        ]) ?>
                                    </div>
                                    <div class="col-md-5" style="padding-right: 0;float: left">
                                        <?= $form->field($model, 'last_name')->textInput([
                                            'maxlength' => true
                                        ]) ?>
                                    </div>
                                    <div class="col-md-12" style="padding: 0;float: left">
                                        <?= $form->field($model, 'address_1')->textInput([
                                            'maxlength' => true
                                        ]) ?>
                                    </div>
                                    <div class="col-md-12" style="padding: 0;float: left">
                                        <?= $form->field($model, 'address_2')->textInput([
                                            'maxlength' => true
                                        ]) ?>
                                    </div>

                                    <div class="col-md-3" style="padding-left: 0;float: left">
                                        <?= $form->field($model, 'block')->textInput([
                                            'maxlength' => true
                                        ]) ?>
                                    </div>
                                    <div class="col-md-3" style="padding-left: 0;float: left">
                                        <?= $form->field($model, 'floor')->textInput([
                                            'maxlength' => true
                                        ]) ?>
                                    </div>
                                    <div class="col-md-3" style="padding-left: 0;float: left">
                                        <?= $form->field($model, 'door_number')->textInput([
                                            'maxlength' => true
                                        ]) ?>
                                    </div>
                                    <div class="col-md-3" style="padding: 0;float: left">
                                        <?= $form->field($model, 'phone')->textInput([
                                            'maxlength' => true
                                        ]) ?>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-md-12" style="padding: 0;float: left">
                                        <?= Html::submitButton(
                                            '<span class="glyphicon glyphicon-ok"></span> ' . t('Save'),
                                            ['class' => 'btn btn-primary']
                                        ) ?>
                                    </div>
                                </div>
                            </div>
                            <?php ActiveForm::end(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>





