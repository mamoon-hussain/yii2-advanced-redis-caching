<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\forms\AddExtraMobileForm $model
 */

$this->title = t("Add Extra Mobile");
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-mobile-confirm">

	<h2 class="text-center"><?= $this->title ?></h2>

	<?php $form = ActiveForm::begin([
		'id'=>'user',
		'layout'=>'horizontal',
		'validateOnBlur'=>false,
	]); ?>

	<?= $form->field($model, 'mobile')->textInput(['maxlength' => 50, 'autocomplete'=>'off', 'autofocus'=>true])?>

	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-9">
			<?= Html::submitButton(
				'<span class="glyphicon glyphicon-ok"></span> ' . t("Add"),
				['class' => 'btn btn-primary']
			) ?>
		</div>
	</div>

	<?php ActiveForm::end(); ?>

</div>
