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

Hello, you have been registered on <?= Yii::$app->params['title'] ?>

<br/><br/>
Your Confirmation Code is: <?= $code ?>
<br/>
Use it to Verify your account.
<br/>
Thank you.