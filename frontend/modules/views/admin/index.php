<?php

use webvimark\modules\UserManagement\components\GhostHtml;
use webvimark\modules\UserManagement\models\rbacDB\Role;
use webvimark\modules\UserManagement\models\Admin;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\Pjax;
use webvimark\extensions\GridBulkActions\GridBulkActions;
use webvimark\extensions\GridPageSize\GridPageSize;
use yii\grid\GridView;

setViewParam('liActive', 'admins');
setViewParam('liinActive', 'admins_all');
/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var webvimark\modules\UserManagement\models\search\UserSearch $searchModel
 */

$this->title = UserManagementModule::t('back', 'Admins');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

	<div class="panel panel-default">
		<div class="panel-body">

			<div class="row">
				<div class="col-sm-6">
					<p>
						<?= GhostHtml::a(
							'<span class="glyphicon glyphicon-plus-sign"></span> ' . UserManagementModule::t('back', 'Create User'),
							['/user/admin/create'],
							['class' => 'btn btn-sm btn-success']
						) ?>
					</p>
				</div>

				<div class="col-sm-6 text-right">
					<?= GridPageSize::widget(['pjaxId'=>'user-grid-pjax']) ?>
				</div>
			</div>


			<?php Pjax::begin([
				'id'=>'user-grid-pjax',
			]) ?>

			<?= GridView::widget([
				'id'=>'user-grid',
				'dataProvider' => $dataProvider,
				'pager'=>[
					'options'=>['class'=>'pagination pagination-sm'],
					'hideOnSinglePage'=>true,
					'lastPageLabel'=>'>>',
					'firstPageLabel'=>'<<',
				],
				'filterModel' => $searchModel,
				'layout'=>'{items}',
				'columns' => [
					['class' => 'yii\grid\SerialColumn', 'options'=>['style'=>'width:10px'] ],

					[
						'class'=>'webvimark\components\StatusColumn',
						'attribute'=>'superadmin',
						'visible'=>Yii::$app->user->isSuperadmin,
					],

//					[
//						'attribute'=>'username',
//						'value'=>function(User $model){
//								return Html::a($model->username,['view', 'id'=>$model->id],['data-pjax'=>0]);
//							},
//						'format'=>'raw',
//					],
					[
						'attribute'=>'email',
                                                'value'=>function(Admin $model){
								return Html::a($model->email,['view', 'id'=>$model->id],['data-pjax'=>0]);
							},
						'format'=>'raw',
					],

//					[
//						'class'=>'webvimark\components\StatusColumn',
//						'attribute'=>'email_confirmed',
//						'visible'=>User::hasPermission('viewUserEmail'),
//					],
					[
						'attribute'=>'gridRoleSearch',
						'filter'=>ArrayHelper::map(Role::getAvailableRoles(Yii::$app->user->isSuperAdmin),'name', 'description'),
						'value'=>function(Admin $model){
								return implode(', ', ArrayHelper::map($model->roles, 'name', 'description'));
							},
						'format'=>'raw',
					],
//					[
//						'attribute'=>'registration_ip',
//						'value'=>function(User $model){
//								return Html::a($model->registration_ip, "http://ipinfo.io/" . $model->registration_ip, ["target"=>"_blank"]);
//							},
//						'format'=>'raw',
//						'visible'=>User::hasPermission('viewRegistrationIp'),
//					],

					[
						'value'=>function(Admin $model){
								return GhostHtml::a(
									UserManagementModule::t('back', t('Roles and permissions')),
									['/user/admin-permission/set', 'id'=>$model->id],
									[
									        'class'=>'btn btn-sm btn-primary',
									        'style'=>'padding: 0;',
                                        'data-pjax'=>0
                                    ]);
							},
						'format'=>'raw',
						'options'=>[
							'width'=>'10px',
						],
					],
//					[
//						'value'=>function(User $model){
//								return GhostHtml::a(
//									UserManagementModule::t('back', t('Change password')),
//									['change-password', 'id'=>$model->id],
//									['class'=>'btn btn-sm btn-default', 'data-pjax'=>0]);
//							},
//						'format'=>'raw',
//						'options'=>[
//							'width'=>'10px',
//						],
//					],
					[
						'class'=>'webvimark\components\StatusColumn',
						'attribute'=>'status',
						'optionsArray'=>[
							[Admin::STATUS_ACTIVE, t('Active'), 'success'],
							[Admin::STATUS_INACTIVE, t('Inactive'), 'warning'],
							[Admin::STATUS_BANNED, t('Banned'), 'danger'],
						],
					],


				],
			]); ?>

			<?php Pjax::end() ?>

		</div>
	</div>
</div>
