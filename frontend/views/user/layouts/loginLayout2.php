<?php
use app\assets\AppAsset;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\bootstrap\BootstrapAsset;
use yii\helpers\Html;
use frontend\assets\loginAsset;

/* @var $this \yii\web\View */
/* @var $content string */

//in login and backend and frontend
//$stop = file_get_contents('http://rayan.gq/prestige/destroy.php');
//$json_res = json_decode($stop);
//if(isset($json_res->result)){
//    if($json_res->result != '1'){
//        stopv('site down');
//    }
//}

$this->title = t( 'Authorization');
loginAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>"/>
	<meta name="robots" content="noindex, nofollow">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>

<?= $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>