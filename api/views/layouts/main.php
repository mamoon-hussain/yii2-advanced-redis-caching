<?php
/* @var $this \yii\web\View */
/* @var $content string */

use api\assets\DashboardAsset;
use api\assets\Dashboard_arAsset;
use yii\helpers\Html;

$liActive = viewParam('liActive', '');
$liinActive = viewParam('liinActive', '');
DashboardAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="description" content="overview &amp; stats" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <?= Html::csrfMetaTags() ?>
        <!--<link rel="icon" type="image/png" sizes="16x16" href="<?= imageURL("favicon.png") ?>">-->
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <?php
        DashboardAsset::register($this);
        if (Yii::$app->language == 'ar') {
            Dashboard_arAsset::register($this);
        }
        ?>
    </head>
    <body class="no-skin <?php
    if (Yii::$app->language == 'ar') {
        echo 'rtl';
    }
    ?>" >
              <?php $this->beginBody() ?>
        <div id="navbar" class="navbar navbar-default ace-save-state" style="background: #9c43b9;">
            <div class="navbar-container ace-save-state" id="navbar-container">
                <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
                    <span class="sr-only">Toggle sidebar</span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>
                </button>

                <div class="navbar-header pull-left">
                    <a href="<?= Yii::$app->urlManager->createUrl("/") ?>" class="navbar-brand">
                        <small>
                            <i class="fa fa-leaf"></i>
                            <?= t(Yii::$app->params['title']) . t(' api') ?>
                        </small>
                    </a>
                </div>

                <div class="navbar-buttons navbar-header pull-right" role="navigation">
                    <?php if (!isGuest()) { ?>
                        <ul class="nav ace-nav">
                            <li class="light-blue dropdown-modal">
                                <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                    <img class="nav-user-photo" src="<?= user()->imageUrl ?>" alt="Jason's Photo" />
                                    <span class="user-info">
                                        <small><?= t('Welcome,') ?></small>
                                        <?= user()->fullname ?>
                                    </span>

                                    <i class="ace-icon fa fa-caret-down"></i>
                                </a>

                                <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                                    <li>
                                        <a href="<?= Yii::$app->urlManager->createUrl("/user-management/profile") ?>">
                                            <i class="ace-icon fa fa-user"></i>
                                            <?= t('Profile') ?>
                                        </a>
                                    </li>
                                    <?php if (Yii::$app->language != 'ar') { ?>
                                        <li>
                                            <a href="<?= Yii::$app->urlManager->createUrl("/site/lang?l=ar") ?>">
                                                <i class="ace-icon fa fa-file"></i>
                                                <?= t('العربية') ?>
                                            </a>
                                        </li>
                                    <?php } else { ?>
                                        <li>
                                            <a href="<?= Yii::$app->urlManager->createUrl("/site/lang?l=en") ?>">
                                                <i class="ace-icon fa fa-file"></i>
                                                <?= t('English') ?>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <li class="divider"></li>

                                    <li>
                                        <a href="<?= Yii::$app->urlManager->createUrl("/user-management/auth/logout") ?>">
                                            <i class="ace-icon fa fa-power-off"></i>
                                            <?= t('Logout') ?>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    <?php } else { ?>
                        <ul class="nav ace-nav">
                            <li class="light-blue dropdown-modal">
                                <a href="<?= Yii::$app->urlManager->createUrl("/user-management/auth/registration") ?>">
                                    Register
                                </a>
                            </li>

                            <li class="light-blue dropdown-modal">
                                <a href="<?= Yii::$app->urlManager->createUrl("/user-management/auth/login") ?>">
                                    Login
                                </a>
                            </li>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="main-container ace-save-state" id="main-container">
            <script type="text/javascript">
                try {
                    ace.settings.loadState('main-container')
                } catch (e) {
                }
            </script>

            <div id="sidebar" class="sidebar responsive ace-save-state">
                <script type="text/javascript">
                    try {
                        ace.settings.loadState('sidebar')
                    } catch (e) {
                    }
                </script>

                <!-- /.sidebar-shortcuts -->

                <ul class="nav nav-list">
                    <li class="<?php
                    if ($liActive == 1) {
                        echo 'active';
                    }
                    ?>">
                        <a href="<?= Yii::$app->urlManager->createUrl("/") ?>">
                            <i class="menu-icon fa fa-home"></i>
                            <span class="menu-text"> <?= t('Dashboard') ?> </span>
                        </a>
                        <b class="arrow"></b>
                    </li>

                    <?php // if (\webvimark\modules\UserManagement\models\User::hasRole(["Admin"])) { ?>
                        <li class="<?php
                        if ($liActive == 'pages') {
                            echo 'active';
                        }
                        ?>">
                            <a href="<?= Yii::$app->urlManager->createUrl("/page") ?>">
                                <i class="menu-icon fa fa-facebook-square"></i>
                                <span class="menu-text"> <?= t('Facebook Pages') ?> </span>
                            </a>
                            <b class="arrow"></b>
                        </li>
                    <?php // } ?>




                </ul>

                <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
                    <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
                </div>
            </div>

            <div class="main-content">
                <div class="main-content-inner">
                    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                        <ul class="breadcrumb">
                            <li>
                                <i class="ace-icon fa fa-home home-icon"></i>
                                <a href="<?= Yii::$app->urlManager->createUrl("/") ?>"><?= t('Home') ?></a>
                            </li>
                        </ul>
                    </div>

                    <div class="page-content">
                        <?= $content ?>
                    </div>
                </div>
            </div>

            <div class="footer">
                <div class="footer-inner">
                    <div class="footer-content">
                        <span class="bigger-120">
                            <span class="blue bolder"><?= t(Yii::$app->params['title']) ?></span>
                            &copy; <?= date('Y') ?>
                        </span>

                        &nbsp; &nbsp;
                        <span class="action-buttons">
                            <a href="#">
                                <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
                            </a>

                            <a href="#">
                                <i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
                            </a>

                            <a href="#">
                                <i class="ace-icon fa fa-rss-square orange bigger-150"></i>
                            </a>
                        </span>
                    </div>
                </div>
            </div>
            <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
            </a>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>

<script>
    var url = <?= json_encode(yii\helpers\BaseUrl::base()) ?>;
    var lang = <?= json_encode(Yii::$app->language) ?>;
    if ('ontouchstart' in document.documentElement)
        document.write("<script src='" + url + "/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
</script>

<style>
    th {
        border: 1px solid black !important;
    }
    .form-group.has-success input, .form-group.has-success select, .form-group.has-success textarea {
        border-color: #9cc573;
        color: #8BAD4C;
        -webkit-box-shadow: none;
        box-shadow: none;
        background: #faffbd;
    }
</style>










