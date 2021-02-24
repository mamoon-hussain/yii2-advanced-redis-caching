<?php

use webvimark\modules\UserManagement\models\Admin;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use webvimark\extensions\BootstrapSwitch\BootstrapSwitch;
use yii\helpers\ArrayHelper;
use webvimark\modules\UserManagement\models\rbacDB\Role;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\User $model
 * @var yii\bootstrap\ActiveForm $form
 */

$direction = 'ltr';
$float = 'left';
if(Yii::$app->language == 'ar'){
    $direction = 'rtl';
    $float = 'right';
}
?>

<div class="user-form">

    <?php
    $form = ActiveForm::begin([
                'id' => 'user',
//                'layout' => 'horizontal',
                'validateOnBlur' => false,
    ]);
    ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => 255, 'autocomplete' => 'off']) ?>

    <?= $form->field($model, 'fname')->textInput(['maxlength' => 50, 'autocomplete' => 'off', 'autofocus' => true]) ?>

    <?= $form->field($model, 'lname')->textInput(['maxlength' => 50, 'autocomplete' => 'off', 'autofocus' => true]) ?>

    <?php if ($model->isNewRecord): ?>

        <?= $form->field($model, 'password')->passwordInput(['maxlength' => 255, 'autocomplete' => 'off']) ?>

        <?= $form->field($model, 'repeat_password')->passwordInput(['maxlength' => 255, 'autocomplete' => 'off']) ?>
    <?php endif; ?>

    <?php
    echo $form->field($model, 'phone', [
        'template' => '

                <div class="form-group">
                {input}
                </div>
                {error}'])->widget(\borales\extensions\phoneInput\PhoneInput::className(), [
        'jsOptions' => [
            'preferredCountries' => ['kw'],
            'excludeCountries' => ['il'],
//                    'preferredCountries' => ['no', 'pl', 'ua'],
//                                'onlyCountries' => ['iq',],
        ]
    ]);
//    echo $form->field($model, 'phone')->textInput(['maxlength' => 50, 'autocomplete' => 'off', 'autofocus' => true])
    ?>

    <?php if (Admin::hasPermission('editUserEmail')): ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

    <?php endif; ?>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <?php if ($model->isNewRecord): ?>
                <?=
                Html::submitButton(
                        '<span class="glyphicon glyphicon-plus-sign"></span> ' . t('Create'), ['class' => 'btn btn-success']
                )
                ?>
            <?php else: ?>
                <?=
                Html::submitButton(
                        '<span class="glyphicon glyphicon-ok"></span> ' . t('Save'), ['class' => 'btn btn-primary']
                )
                ?>
            <?php endif; ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php BootstrapSwitch::widget() ?>

<style>
    .select2-container{
        direction: <?= $direction ?>;
        text-align: <?= $float ?>;
    }
    form > .mb-3{
        text-align: <?= $float ?>;
    }
    form{
        text-align: <?= $float ?>;
        direction: <?= $direction ?>;
    }
</style>
