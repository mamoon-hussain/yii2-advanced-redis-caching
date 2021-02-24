<?php
/**
 * @var $this yii\web\View
 * @var $user webvimark\modules\UserManagement\models\User
 */
use yii\helpers\Html;
$user = webvimark\modules\UserManagement\models\ZUser::findOne(userId());
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['/user-management/profile/invoices-password-recovery-receive', 'token' => $user->confirmation_token]);
?>

Hello <?= Html::encode(user()->username) ?>, follow this link to reset your invoice password:

<?= Html::a('Reset password', $resetLink) ?>