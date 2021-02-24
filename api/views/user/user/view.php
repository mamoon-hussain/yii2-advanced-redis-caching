<?php

use webvimark\modules\UserManagement\components\GhostHtml;
use webvimark\modules\UserManagement\models\rbacDB\Role;
use webvimark\modules\UserManagement\models\User;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\User $model
 */
$this->title = $model->username;
setViewParam('liActive', 'users');
setViewParam('liinActive', 'users_all');
?>
<div class="panel panel-default">
    <div class="panel-body">

            <p>
                <?= Html::a(t('Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) ?>
                <?= Html::a(t('Create'), ['create'], ['class' => 'btn btn-sm btn-success']) ?>
                <?= Html::a(t('Change Password'), ['change-password', 'id' => $model->id], [
                        'class' => 'btn btn-sm btn-warning',
                    'style' => 'color: white;',
                ]) ?>
                <?=
                Html::a(t('Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-sm btn-danger pull-right',
                    'data' => [
                        'confirm' => UserManagementModule::t('back', 'Are you sure you want to delete this user?'),
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
                    [
                        'label' => 'City',
                        'value' => $model->area_id ? $model->area->city->en_name : $model->area_id,
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'area_id',
                        'value' => $model->area_id ? $model->area->en_name : $model->area_id,
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'image',
                        'value' => '<img src="' . $model->imageUrl . '" class="img-sm" style="max-height: 100px; max-width: 100px;">',
                        'format' => 'raw',
                    ],
                    'created_at:datetime',
                    'updated_at:datetime',
                ],
            ])
            ?>
        </div>
    </div>

