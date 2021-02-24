<?php

use webvimark\modules\UserManagement\components\GhostHtml;
use webvimark\modules\UserManagement\models\rbacDB\Role;
use webvimark\modules\UserManagement\models\User;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\User $model
 */
$this->title = $model->username;
?>
<div class="user-view">



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

    <div class="panel panel-default">
        <div class="panel-body">

            <p>
                <?= Html::a('Edit', ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) ?>
                <?= Html::a('Create', ['create'], ['class' => 'btn btn-sm btn-success']) ?>
                <?= Html::a('Change Password', ['change-password', 'id' => $model->id], ['class' => 'btn btn-sm btn-warning']) ?>
                <?=
                Html::a(t('all', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-sm btn-danger pull-right',
                    'data' => [
                        'confirm' => t('all', 'Are you sure you want to delete this user?'),
                        'method' => 'post',
                    ],
                ])
                ?>
            </p>

            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    [
                        'attribute' => 'status',
                        'value' => User::getStatusValue($model->status),
                    ],
                    'username',
                    'fname',
                    'lname',
                    [
                        'attribute' => 'email',
                        'value' => $model->email,
                        'format' => 'email',
                        'visible' => User::hasPermission('viewUserEmail'),
                    ],
                    [
                        'attribute' => 'email_confirmed',
                        'value' => $model->email_confirmed,
                        'format' => 'boolean',
                        'visible' => User::hasPermission('viewUserEmail'),
                    ],
                    'phone',
                    'address',
                    'city',
                    'state',
                    'zip_postal_code',
                    'fax_num',
                    'created_at:datetime',
                    'updated_at:datetime',
                ],
            ])
            ?>
        </div>
    </div>


</div>


