<?php
/**
 * @var $this yii\web\View
 * @var $user webvimark\modules\UserManagement\models\User
 */
use yii\helpers\Html;

?>
<?php
$returnUrl = Yii::$app->user->returnUrl == Yii::$app->homeUrl ? null : rtrim(Yii::$app->homeUrl, '/') . Yii::$app->user->returnUrl;

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['/user/auth/login']);
        echo $this->render('_email_header');

?>

Hallo liebe/r Kunde/Kundin, Sie sind registriert am <?= Yii::$app->params['title'] ?>

<br/><br/>
Ihr Passwort lautet: <?= $pass ?>
<br/>
Benutzen Sie sie, um auf Ihr Konto zuzugreifen.
<br/>
<?= Html::a(t('Anmeldung'), $confirmLink) ?>
<br/>
Danke.

<?php
        echo $this->render('_email_footer');
?>