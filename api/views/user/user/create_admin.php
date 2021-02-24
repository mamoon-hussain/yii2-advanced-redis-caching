<?php

use webvimark\modules\UserManagement\UserManagementModule;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\User $model
 */

$this->title = UserManagementModule::t('back', 'Admin creation');
$this->params['breadcrumbs'][] = ['label' => UserManagementModule::t('back', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
setViewParam('liActive', 'admins');
setViewParam('liinActive', 'admins_all');
?>
<div class="user-create">

	<div class="panel panel-default">
		<div class="panel-body">

			<?= $this->render('_form_admin', compact('model')) ?>
		</div>
	</div>

</div>
