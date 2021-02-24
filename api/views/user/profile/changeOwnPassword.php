<?php

use webvimark\modules\UserManagement\models\forms\ChangeOwnPasswordForm;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\forms\ChangeOwnPasswordForm $model
 */

$this->title = t('Password Update');
$this->params['breadcrumbs'][] = $this->title;
$Maintitle = t(Yii::$app->params['title']);
$storeTitle = t(Yii::$app->params['title']);
setViewParam('liActive', 'tc');
setViewParam('liinActive', 'tc');
?>
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>
                <?= $this->title ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="user-form">
                    <?php $form = ActiveForm::begin(); ?>

                    <?php if ( $model->scenario != 'restoreViaEmail' ): ?>
                        <?= $form->field($model, 'current_password')->passwordInput(['maxlength' => 255, 'autocomplete'=>'off']) ?>
                    <?php endif; ?>


                    <?= $form->field($model, 'password')->passwordInput(['maxlength' => 255, 'autocomplete'=>'off']) ?>

                    <?= $form->field($model, 'repeat_password')->passwordInput(['maxlength' => 255, 'autocomplete'=>'off']) ?>




                    <?= Html::submitButton(
                        '<span class="glyphicon glyphicon-ok"></span> ' . t('Save'),
                        ['class' => 'btn btn-success']
                    ) ?>


                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>

    </div>
</div>