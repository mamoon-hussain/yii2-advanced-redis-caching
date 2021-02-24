<?php

use webvimark\modules\UserManagement\models\User;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use webvimark\extensions\BootstrapSwitch\BootstrapSwitch;
use yii\helpers\ArrayHelper;
use common\models\Center;

$this->title = 'Update Admin Profile';
/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\User $model
 * @var yii\bootstrap\ActiveForm $form
 */
?>

    <div class="user-form">
        <div class="panel panel-default">
            <div class="panel-body">

                <h1><?= Html::encode($this->title) ?></h1>

                <?php $form = ActiveForm::begin([
                    'id'=>'user',
                    'validateOnBlur' => false,
                ]); ?>

                <?= $form->field($model, 'username')->textInput(['maxlength' => 255, 'autocomplete'=>'off']) ?>

                <?= $form->field($model, 'fname')->textInput(['maxlength' => 50, 'autocomplete'=>'off', 'autofocus'=>true]) ?>

                <?= $form->field($model, 'lname')->textInput(['maxlength' => 50, 'autocomplete'=>'off', 'autofocus'=>true]) ?>

                <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

                <div class="col-md-6" style="padding-left: 0;">
                    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6" style="padding-right: 0;">
                    <?= $form->field($model, 'tax_id')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-md-3" style="padding-left: 0;">
                    <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'state')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3" style="padding-right: 0;">
                    <?= $form->field($model, 'zip')->textInput(['maxlength' => true]) ?>
                </div>

                <?= $form->field($model, 'address')->textarea(['rows' => 6])
                    ->label('Address Line 1 (Street address, P.O, box, company name, c/o)') ?>

                <?= $form->field($model, 'address_2')->textarea(['rows' => 6])
                    ->label('Address Line 2 (Apartment, suite, unit, building, floor, etc)') ?>

                <?php if ( $model->isNewRecord ): ?>
                    <?= Html::submitButton(
                        '<span class="glyphicon glyphicon-plus-sign"></span> ' . t('Create'),//t('all', 'Create'),
                        ['class' => 'btn btn-success']
                    ) ?>
                <?php else: ?>
                    <?= Html::submitButton(
                        '<span class="glyphicon glyphicon-ok"></span> ' . t('Save'),//t('all', 'Save'),
                        ['class' => 'btn btn-primary']
                    ) ?>
                <?php endif; ?>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>


<?php BootstrapSwitch::widget() ?>