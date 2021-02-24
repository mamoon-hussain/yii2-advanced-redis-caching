<?php

use webvimark\modules\UserManagement\components\GhostHtml;
use webvimark\modules\UserManagement\models\rbacDB\Role;
use webvimark\modules\UserManagement\models\User;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\User $model
 */
$this->title = t('Admin: ') . $model->username;
$this->params['breadcrumbs'][] = ['label' => UserManagementModule::t('back', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
setViewParam('liActive', 'admins');
setViewParam('liinActive', 'admins_all');
?>
<div class="panel panel-default">
    <div class="panel-body">

                <p>
                    <?= GhostHtml::a(t('Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= GhostHtml::a(t('Create'), ['create'], ['class' => 'btn btn-success']) ?>
                    <?=
                    GhostHtml::a(
                        t('Roles and permissions'), ['/user-management/admin-permission/set', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']
                    )
                    ?>

                    <?= Html::a(t('Change Password'), ['change-password', 'id' => $model->id], [
                            'class' => 'btn btn-sm btn-warning',
                        'style' => 'color: white;'
                    ]) ?>

                    <?=
                    GhostHtml::a(t('Delete'), ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-sm btn-danger pull-right',
                        'data' => [
                            'confirm' => t('Are you sure you want to delete this user?'),
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
                        [
                            'label' => t('Roles'),
                            'value' => implode('<br>', ArrayHelper::map(Role::getUserRoles($model->id), 'name', 'description')),
                            'visible' => User::hasPermission('viewUserRoles'),
                            'format' => 'raw',
                        ],
//					[
//						'attribute'=>'bind_to_ip',
//						'visible'=>User::hasPermission('bindUserToIp'),
//					],
//					array(
//						'attribute'=>'registration_ip',
//						'value'=>Html::a($model->registration_ip, "http://ipinfo.io/" . $model->registration_ip, ["target"=>"_blank"]),
//						'format'=>'raw',
//						'visible'=>User::hasPermission('viewRegistrationIp'),
//					),
                        'created_at:datetime',
                        'updated_at:datetime',
                    ],
                ])
                ?>

    </div>
</div>

