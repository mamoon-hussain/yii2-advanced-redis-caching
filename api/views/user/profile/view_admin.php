<?php

use webvimark\modules\UserManagement\components\GhostHtml;
use webvimark\modules\UserManagement\models\rbacDB\Role;
use webvimark\modules\UserManagement\models\User;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\User $model
 */
$this->title = t('Admin: ') . $model->username;
$this->params['breadcrumbs'][] = ['label' => UserManagementModule::t('back', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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

                <p>
                    <?= GhostHtml::a(t('Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) ?>
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
    </div>
</div>

