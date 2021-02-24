<?php

use webvimark\modules\UserManagement\models\User;
use webvimark\extensions\BootstrapSwitch\BootstrapSwitch;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\User $model
 */

$this->title = t('Editing admin: ') . ' ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => UserManagementModule::t('back', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = UserManagementModule::t('back', 'Editing');
setViewParam('liActive', 'users');
setViewParam('liinActive', 'admins_all');
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

                <?= $this->render('_form', compact('model')) ?>
            </div>
        </div>

    </div>
</div>