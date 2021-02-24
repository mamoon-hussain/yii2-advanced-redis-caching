<?php

/**
 * @var yii\web\View $this
 * @var array $permissionsByGroup
 * @var webvimark\modules\UserManagement\models\User $user
 */
use webvimark\modules\UserManagement\models\rbacDB\Role;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\bootstrap\BootstrapPluginAsset;
use yii\helpers\ArrayHelper;
use webvimark\modules\UserManagement\models\rbacDB\Permission;
use yii\helpers\Html;

BootstrapPluginAsset::register($this);
$this->title = t('Roles and permissions for user') . ':' . ' ' . $user->username;

$this->params['breadcrumbs'][] = ['label' => UserManagementModule::t('back', 'Users'), 'url' => ['/user/user/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span> <?= t('Roles')//UserManagementModule::t('back', 'Roles')     ?>
                </strong>
            </div>
            <div class="panel-body">

                <?= Html::beginForm(['set-roles', 'id' => $user->id]) ?>

                <?=
                Html::checkboxList(
                        'roles', ArrayHelper::map(Role::getUserRoles($user->id), 'name', 'name'), ArrayHelper::map(Role::getAvailableRoles(), 'name', 'description'), [
                    'item' => function ($index, $label, $name, $checked, $value) {
                        $list = '<ul style="padding-left: 10px">';
                        foreach (Role::getPermissionsByRole($value) as $permissionName => $permissionDescription) {
                            $list .= $permissionDescription ? "<li>{$permissionDescription}</li>" : "<li>{$permissionName}</li>";
                        }
                        $list .= '</ul>';

                        $isChecked = $checked ? 'checked' : '';
                        $checkbox = "<label><input type='checkbox' name='{$name}' value='{$value}' {$isChecked}> {$label}</label>";

                        return $checkbox;
                    },
                    'separator' => '<br>',
                        ]
                )
                ?>
                <br/>

                <?php if (Yii::$app->user->isSuperadmin OR Yii::$app->user->id != $user->id): ?>

                    <?=
                    Html::submitButton(
                            '<span class="glyphicon glyphicon-ok"></span> ' . t('Save'), //UserManagementModule::t('back', 'Save'),
                            ['class' => 'btn btn-primary btn-sm']
                    )
                    ?>
                <?php else: ?>
                    <div class="alert alert-warning well-sm text-center">
                        <?= UserManagementModule::t('back', 'You can not change own permissions') ?>
                    </div>
                <?php endif; ?>


                <?= Html::endForm() ?>
            </div>
        </div>
    </div>
</div>