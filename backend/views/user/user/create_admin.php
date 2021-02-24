<?php

use webvimark\modules\UserManagement\UserManagementModule;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\User $model
 */

$this->title =t( 'Admin creation');
$this->params['breadcrumbs'][] = ['label' =>t( 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

	<h2 class="lte-hide-title"><?= $this->title ?></h2>

	<div class="panel panel-default">
		<div class="panel-body">

			<?= $this->render('_form_admin', compact('model')) ?>
		</div>
	</div>

</div>
