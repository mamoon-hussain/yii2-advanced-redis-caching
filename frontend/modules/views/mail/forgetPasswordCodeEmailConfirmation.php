<?php
/**
 * @var $this yii\web\View
 * @var $user webvimark\modules\UserManagement\models\User
 */
use yii\helpers\Html;

?>
<?php
//$returnUrl = Yii::$app->user->returnUrl == Yii::$app->homeUrl ? null : rtrim(Yii::$app->homeUrl, '/') . Yii::$app->user->returnUrl;
        echo $this->render('_email_header');

?>

Hallo liebe/r Kunde/Kundin,

<br/><br/>
Ihr Bestätigungscode zum Zurücksetzen des Passworts lautet: <?= $code ?>
<br/>
Thank you.

<?php
        echo $this->render('_email_footer');
?>