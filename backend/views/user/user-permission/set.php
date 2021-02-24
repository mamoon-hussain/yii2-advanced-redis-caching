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

$this->params['breadcrumbs'][] = ['label' =>t( 'Users'), 'url' => ['/user/user/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h2 class="lte-hide-title"><?= $this->title ?></h2>

<div class="row">
    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span> <?= t('Roles')//t('all', 'Roles')     ?>
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
                            '<span class="glyphicon glyphicon-ok"></span> ' . t('Save'), //t('all', 'Save'),
                            ['class' => 'btn btn-primary btn-sm']
                    )
                    ?>
                <?php else: ?>
                    <div class="alert alert-warning well-sm text-center">
                        <?=t( 'You can not change own permissions') ?>
                    </div>
                <?php endif; ?>


                <?= Html::endForm() ?>
            </div>
        </div>
    </div>
</div>