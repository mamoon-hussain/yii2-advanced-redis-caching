<?php

use webvimark\modules\UserManagement\models\Admin;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use webvimark\extensions\BootstrapSwitch\BootstrapSwitch;
use yii\helpers\ArrayHelper;
use webvimark\modules\UserManagement\models\rbacDB\Role;
setViewParam('liActive', 'admins');
setViewParam('liinActive', 'admins_all');
/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\User $model
 * @var yii\bootstrap\ActiveForm $form
 */
?>

<div class="user-form">

    <?php
    $form = ActiveForm::begin([
                'id' => 'user',
                'layout' => 'horizontal',
                'validateOnBlur' => false,
    ]);
    ?>

    <?php if ($model->isNewRecord): ?>
        <?=
                $form->field($model, 'role')
                ->dropDownList(ArrayHelper::map(Role::find()->all(), 'name', 'name'))
        ?>
    <?php endif; ?>
    
    <?=
            $form->field($model->loadDefaultValues(), 'status')
            ->dropDownList(Admin::getStatusList())
    ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => 255, 'autocomplete' => 'off']) ?>

    <?= $form->field($model, 'fname')->textInput(['maxlength' => 50, 'autocomplete' => 'off', 'autofocus' => true]) ?>

    <?= $form->field($model, 'lname')->textInput(['maxlength' => 50, 'autocomplete' => 'off', 'autofocus' => true]) ?>

    <?php if ($model->isNewRecord): ?>

        <?= $form->field($model, 'password')->passwordInput(['maxlength' => 255, 'autocomplete' => 'off']) ?>

        <?= $form->field($model, 'repeat_password')->passwordInput(['maxlength' => 255, 'autocomplete' => 'off']) ?>
    <?php endif; ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => 50, 'autocomplete' => 'off', 'autofocus' => true]) ?>

    <?php if (Admin::hasPermission('editUserEmail')): ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>
        <?= $form->field($model, 'email_confirmed')->checkbox() ?>

    <?php endif; ?>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <?php if ($model->isNewRecord): ?>
                <?=
                Html::submitButton(
                        '<span class="glyphicon glyphicon-plus-sign"></span> ' . t('all', 'Create'), ['class' => 'btn btn-success']
                )
                ?>
            <?php else: ?>
                <?=
                Html::submitButton(
                        '<span class="glyphicon glyphicon-ok"></span> ' . t('all', 'Save'), ['class' => 'btn btn-primary']
                )
                ?>
            <?php endif; ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php BootstrapSwitch::widget() ?>