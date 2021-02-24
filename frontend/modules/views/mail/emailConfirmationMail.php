<?php
/**
 * @var $this yii\web\View
 * @var $user webvimark\modules\UserManagement\models\User
 */
use yii\helpers\Html;

?>
<?php
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['/user/auth/confirm-email-receive', 'token' => $user->confirmation_token]);
        echo $this->render('_email_header');
?>


Hallo liebe/r Kunde/Kundin, <?= Html::encode($user->username) ?>, Folgen Sie diesem Link, um Ihre E-Mail zu bestätigen:

<?= Html::a('Confirm E-mail', $resetLink) ?>


<?php
        echo $this->render('_email_footer');
?>