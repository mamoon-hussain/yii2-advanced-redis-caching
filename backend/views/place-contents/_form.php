<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use common\enums\ActiveInactiveStatus;
use common\models\Place;

/* @var $this yii\web\View */
/* @var $model common\models\PlaceContents */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="place-contents-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    echo $form->field($model, 'place_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Place::find()->andWhere(['status' => ActiveInactiveStatus::active])->all(), 'id', 'name'),
        'options' => [
            'class' => 'place_select',
            'placeholder' => t('Select'),
        ],
    ]);
    ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
