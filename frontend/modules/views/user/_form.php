<?php

use webvimark\modules\UserManagement\models\User;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use webvimark\extensions\BootstrapSwitch\BootstrapSwitch;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\User $model
 * @var yii\bootstrap\ActiveForm $form
 */
?>

<div class="user-form">

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

    <?php
    $form = ActiveForm::begin([
                'id' => 'user',
                'layout' => 'horizontal',
                'validateOnBlur' => false,
    ]);
    ?>

    <?=
            $form->field($model->loadDefaultValues(), 'status')
            ->dropDownList(User::getStatusList())
    ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => 255, 'autocomplete' => 'off']) ?>

    <?= $form->field($model, 'fname')->textInput(['maxlength' => 50, 'autocomplete' => 'off', 'autofocus' => true]) ?>

    <?= $form->field($model, 'lname')->textInput(['maxlength' => 50, 'autocomplete' => 'off', 'autofocus' => true]) ?>

    <?php if ($model->isNewRecord): ?>

        <?= $form->field($model, 'password')->passwordInput(['maxlength' => 255, 'autocomplete' => 'off']) ?>

        <?= $form->field($model, 'repeat_password')->passwordInput(['maxlength' => 255, 'autocomplete' => 'off']) ?>
    <?php endif; ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => 50, 'autocomplete' => 'off', 'autofocus' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'email_confirmed')->checkbox() ?>

    <?= $form->field($model, 'address')->textInput([]) ?>
    <?= $form->field($model, 'city')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'state')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'zip_postal_code')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'fax_num')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <?php if ($model->isNewRecord): ?>
                <?=
                Html::submitButton(
                        '<span class="glyphicon glyphicon-plus-sign"></span> ' . UserManagementModule::t('back', 'Create'), ['class' => 'btn btn-success']
                )
                ?>
            <?php else: ?>
                <?=
                Html::submitButton(
                        '<span class="glyphicon glyphicon-ok"></span> ' . UserManagementModule::t('back', 'Save'), ['class' => 'btn btn-primary']
                )
                ?>
            <?php endif; ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php BootstrapSwitch::widget() ?>