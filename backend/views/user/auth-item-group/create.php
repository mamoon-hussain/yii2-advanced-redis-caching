<?php

use webvimark\modules\UserManagement\UserManagementModule;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\rbacDB\AuthItemGroup $model
 */

$this->title =t( 'Creating permission group');
$this->params['breadcrumbs'][] = ['label' =>t( 'Permission groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-group-create">

	<h2 class="lte-hide-title"><?= $this->title ?></h2>

	<div class="panel panel-default">
		<div class="panel-body">

			<?= $this->render('_form', compact('model')) ?>
		</div>
	</div>

</div>
