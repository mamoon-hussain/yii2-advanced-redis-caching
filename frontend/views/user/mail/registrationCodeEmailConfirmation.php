<?php
/**
 * @var $this yii\web\View
 * @var $user webvimark\modules\UserManagement\models\User
 */
use yii\helpers\Html;

?>
<?php
//$returnUrl = Yii::$app->user->returnUrl == Yii::$app->homeUrl ? null : rtrim(Yii::$app->homeUrl, '/') . Yii::$app->user->returnUrl;
?>
<?php
//$returnUrl = Yii::$app->user->returnUrl == Yii::$app->homeUrl ? null : rtrim(Yii::$app->homeUrl, '/') . Yii::$app->user->returnUrl;
        echo $this->render('_email_header');

?>

Hallo liebe/r Kunde/Kundin,Sie sind registriert am <?= Yii::$app->params['title'] ?>

<br/><br/>
Ihr Bestätigungscode lautet: <?= $code ?>
<br/>
Benutzen Sie es, um Ihr Konto zu verifizieren.
<br/>
Vielen Dank.
<?php
        echo $this->render('_email_footer');
?>