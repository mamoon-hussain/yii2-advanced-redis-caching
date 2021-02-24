<?php

use webvimark\modules\UserManagement\components\GhostHtml;
use webvimark\modules\UserManagement\models\rbacDB\Role;
use webvimark\modules\UserManagement\models\ZUser;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\ZUser $model
 */
$this->title = 'Profile Password';

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h2 class="lte-hide-title"><?= $this->title ?></h2>

    <div class="panel panel-default">
        <div class="panel-body">

            <?php $form = ActiveForm::begin(); ?>

            <?=
            $form->field($model, 'editPassword')->passwordInput();
            ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
            
        </div>
    </div>
</div>
