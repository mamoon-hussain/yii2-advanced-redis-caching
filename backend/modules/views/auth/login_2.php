<?php

/**
 * @var $this yii\web\View
 * @var $model webvimark\modules\UserManagement\models\forms\LoginForm
 */
use webvimark\modules\UserManagement\components\GhostHtml;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\authclient\widgets\AuthChoice;
?>

<div class="container" id="login-wrapper">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= t('Project-Frontend Authorization'); ?></h3>
                </div>
                <div class="panel-body">

                    <?php
                    $form = ActiveForm::begin([
                                'id' => 'login-form',
                                'options' => ['autocomplete' => 'off'],
                                'validateOnBlur' => false,
                                'fieldConfig' => [
                                    'template' => "{input}\n{error}",
                                ],
                            ])
                    ?>



                    <?php ActiveForm::end() ?>

                    <?php
                    $authAuthChoice = AuthChoice::begin([
                                'baseAuthUrl' => ['/site/auth']
                    ]);
                    ?>
                    
                    <?php foreach ($authAuthChoice->getClients() as $client): ?>
                    <?= $authAuthChoice->clientLink($client) ?>
                <?php endforeach; ?>
                </div>
            </div>

            <?php AuthChoice::end(); ?>
        </div>
    </div>
</div>

<?php
$css = <<<CSS
html, body {
	background: #eee;
	-webkit-box-shadow: inset 0 0 100px rgba(0,0,0,.5);
	box-shadow: inset 0 0 100px rgba(0,0,0,.5);
	height: 100%;
	min-height: 100%;
	position: relative;
}
#login-wrapper {
	position: relative;
	top: 30%;
}
#login-wrapper .registration-block {
	margin-top: 15px;
}
CSS;

$this->registerCss($css);
?>