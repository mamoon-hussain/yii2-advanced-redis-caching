<?php

/**
 * @var yii\widgets\ActiveForm $form
 * @var array $childRoles
 * @var array $allRoles
 * @var array $routes
 * @var array $currentRoutes
 * @var array $permissionsByGroup
 * @var array $currentPermissions
 * @var yii\rbac\Role $role
 */

use webvimark\modules\UserManagement\components\GhostHtml;
use webvimark\modules\UserManagement\models\rbacDB\Role;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\helpers\ArrayHelper;
use yii\helpers\Html as HtmlAlias;
use yii\widgets\DetailView;

setViewParam('liActive', 'admins');
setViewParam('liinActive', 'role');

$this->title = t('all', 'Permissions for role:') . ' ' . $role->description;
$this->params['breadcrumbs'][] = ['label' => t('all', 'Roles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="tags-create">
                        <?php if (Yii::$app->session->hasFlash('success')): ?>
                            <div class="alert alert-success text-center">
                                <?= Yii::$app->session->getFlash('success') ?>
                            </div>
                        <?php endif; ?>

                        <div class="row">

                            <div class="col-sm-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4>
                                            <span class="glyphicon glyphicon-th"></span>
                                            <?= HtmlAlias::encode($this->title) ?>:
                                        </h4>
                                    </div>
                                    <div class="panel-body">
                                        <?= HtmlAlias::beginForm(['set-child-permissions', 'id' => $role->name]) ?>

                                        <div class="row">
                                            <?php foreach ($permissionsByGroup as $groupName => $permissions): ?>
                                                <div class="col-sm-6">
                                                    <fieldset>
                                                        <legend><?= $groupName ?></legend>

                                                        <?php foreach ($permissions as $permission): ?>
                                                            <label>
                                                                <?php $isChecked = in_array($permission->name, ArrayHelper::map($currentPermissions, 'name', 'name')) ? 'checked' : '' ?>
                                                                <input type="checkbox" <?= $isChecked ?>
                                                                       name="child_permissions[]"
                                                                       value="<?= $permission->name ?>">
                                                                <?= $permission->description ?>
                                                            </label>

                                                            <br/>
                                                        <?php endforeach ?>

                                                    </fieldset>
                                                    <br/>
                                                </div>


                                            <?php endforeach ?>
                                        </div>

                                        <hr/>
                                        <?= HtmlAlias::submitButton(
                                            '<span class="glyphicon glyphicon-ok"></span> ' . t('all', 'Save'),
                                            ['class' => 'btn btn-primary btn-sm']
                                        ) ?>

                                        <?= HtmlAlias::endForm() ?>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
$this->registerJs(<<<JS

$('.role-help-btn').off('mouseover mouseleave')
	.on('mouseover', function(){
		var _t = $(this);
		_t.popover('show');
	}).on('mouseleave', function(){
		var _t = $(this);
		_t.popover('hide');
	});
JS
);
?>