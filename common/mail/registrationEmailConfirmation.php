<?php
/**
 * @var $this yii\web\View
 * @var $user webvimark\modules\UserManagement\models\User
 */
use yii\helpers\Html;

?>
<?php
$returnUrl = Yii::$app->user->returnUrl == Yii::$app->homeUrl ? null : rtrim(Yii::$app->homeUrl, '/') . Yii::$app->user->returnUrl;

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['/user/auth/confirm-registration-email', 'token' => $user->confirmation_token, 'returnUrl'=>$returnUrl]);
       echo $this->render('_email_header');

?>

Hallo liebe/r Kunde/Kundin,Sie sind registriert am <?= Yii::$app->urlManager->hostInfo ?>

<br/><br/>
Folgen Sie diesem Link, um Ihre E-Mail zu bestätigen und Ihr Konto zu aktivieren:

<?= Html::a('confirm E-mail', $confirmLink) ?>

<?php
        echo $this->render('_email_footer');
?>