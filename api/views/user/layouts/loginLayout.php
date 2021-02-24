<?php
use app\assets\AppAsset;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\bootstrap\BootstrapAsset;
use yii\helpers\Html;
use backend\assets\loginAsset;

$this->title = t('Authorization');
loginAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= Html::encode($this->title) ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
</head>
<body class="hold-transition login-page">
<?php $this->beginBody() ?>

<div class="login-box">
    <div class="login-logo">
        <a href="<?= Yii::$app->urlManager->createUrl("/") ?>"><b><?= t(Yii::$app->params['title']) ?></b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <?= $content ?>
    </div>
    <!-- /.login-box-body -->
</div>

<?php $this->endBody() ?>
</body>
</html>

<?php $this->endPage() ?>

<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
</script>