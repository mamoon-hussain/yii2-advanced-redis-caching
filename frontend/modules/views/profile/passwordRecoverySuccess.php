<?php

use webvimark\modules\UserManagement\UserManagementModule;

/**
 * @var yii\web\View $this
 */

$this->title = t( 'Password recovery');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="password-recovery-success">

	<div class="alert alert-success text-center">
		<?= t( 'Check your E-mail for further instructions') ?>
	</div>

</div>
