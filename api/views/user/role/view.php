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
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = UserManagementModule::t('back', 'Permissions for role:') . ' ' . $role->description;
$this->params['breadcrumbs'][] = ['label' => UserManagementModule::t('back', 'Roles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h2 class="lte-hide-title"><?= $this->title ?></h2>

<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success text-center">
        <?= Yii::$app->session->getFlash('success') ?>
    </div>
<?php endif; ?>

<p>
    <?= GhostHtml::a(UserManagementModule::t('back', 'Edit'), ['update', 'id' => $role->name], ['class' => 'btn btn-sm btn-primary']) ?>
    <?php GhostHtml::a(UserManagementModule::t('back', 'Create'), ['create'], ['class' => 'btn btn-sm btn-success']) ?>
</p>

<?=
DetailView::widget([
    'model' => $role,
    'attributes' => [
        'description',
        'name',
    ],
])
?>