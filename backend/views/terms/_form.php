<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\enums\ActiveInactiveStatus;
use common\models\State;
use common\models\City;
use borales\extensions\phoneInput\PhoneInput;
use kartik\file\FileInput;

$dir = 'rtl';
if(Yii::$app->language != 'ar'){
    $dir = 'ltr';
}
setViewParam('liActive', 'terms');
?>


<?php $form = ActiveForm::begin(); ?>
<div class="panel panel-default">
    <div class="panel-body">



        <?php
        echo  $form->field($model, 'description')->widget(\dosamigos\tinymce\TinyMce::className(), [
            'options' => ['rows' => 6],
            'language' => api_lang(),
            'clientOptions' => [
                'plugins' => [
                    "advlist autolink lists link charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste"
                ],
                'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            ]
        ]);
        ?>


        <div class="form-group">
            <?= Html::submitButton(t('Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<style>
    .iti {
        width: 100%;
        direction: ltr;
    }
</style>