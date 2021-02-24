<?php

use webvimark\modules\UserManagement\UserManagementModule;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\User $model
 */

$this->title = UserManagementModule::t('back', 'Admin creation');
setViewParam('liActive', 'admins');
setViewParam('liinActive', 'admins_all');
?>
<div class="panel panel-default">
    <div class="panel-body">

                <?= $this->render('_form', compact('model')) ?>

    </div>
</div>
