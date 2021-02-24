<?php

use kartik\select2\Select2;
use webvimark\modules\UserManagement\models\ZUser;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\search\UserSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="col-lg-4" style="background: #85d0fb; padding-bottom: 1%;height: 60px;">
        <?=
        $form->field($model, 'username', [
            'template' => '<div class="form-inline"> 
                                        <div class="col-lg-12" style="padding: 0;">{input}</div>
                                        {error}
                </div>'])->widget(Select2::classname(), [
            'data' => ArrayHelper::map(ZUser::find()->all(), 'username', 'fullname'),
            'options' => ['placeholder' => t('Search by Customer')],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label('')
        ?>
    </div>
    <div class="col-lg-4" style="background: #85d0fb; padding-bottom: 1%;height: 60px;padding-left: 0;">
        <?=
        $form->field($model, 'email', [
            'template' => '<div class="form-inline"> 
                                        <div class="col-lg-12" style="padding: 0;">{input}</div>
                                        {error}
                </div>'])->textInput([
            'maxlength' => true,
            'placeholder' => 'Email',
            'style' => 'width: 100%;'
        ])->label('')
        ?>
    </div>
    <div class="col-lg-4" style="background: #85d0fb; padding-bottom: 1%;height: 60px;padding-left: 0;">
        <?=
        $form->field($model, 'phone', [
            'template' => '<div class="form-inline"> 
                                        <div class="col-lg-12" style="padding: 0;">{input}</div>
                                        {error}
                </div>'])->textInput([
            'maxlength' => true,
            'placeholder' => 'Phone',
            'style' => 'width: 100%;'
        ])->label('')
        ?>
    </div>


    <div class="col-lg-12" style="background: #85d0fb; margin-bottom: 1%; text-align: center;">
        <div class="form-group" style="margin-top: 1%;">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
