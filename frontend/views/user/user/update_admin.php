<?php

use webvimark\modules\UserManagement\models\User;
use webvimark\extensions\BootstrapSwitch\BootstrapSwitch;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\User $model
 */

$this->title = t('all', 'Editing Admin: ') . ' ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => t('all', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = t('all', 'Editing');
?>
<div class="user-update">

	<h2 class="lte-hide-title"><?= $this->title ?></h2>

	<div class="panel panel-default">
		<div class="panel-body">

			<?= $this->render('_form_admin', compact('model')) ?>
		</div>
	</div>

</div>