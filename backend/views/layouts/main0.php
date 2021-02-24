<?php
/* @var $this \yii\web\View */

/* @var $content string */

use backend\assets\DashboardAsset;
use backend\assets\DashboardLtRAsset;
use backend\assets\DashboardRtLAsset;
use yii\helpers\Html;
use common\models\Admin;
use yii\helpers\Url;
use common\enums\PaintingToolType;
use common\enums\PlaceType;

$liActive = viewParam('liActive', '');
$liinActive = viewParam('liinActive', '');
$liininActive = viewParam('liininActive', '');
if(Yii::$app->language != 'en'){
    DashboardRtLAsset::register($this);
} else {
    DashboardLtRAsset::register($this);
}

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?php
    if(Yii::$app->language != 'en'){
        DashboardRtLAsset::register($this);
    } else {
        DashboardLtRAsset::register($this);
    }
    ?>
    <?= Html::csrfMetaTags() ?>
    <link rel="apple-touch-icon" href="<?= imageURL('apple-icon-120.png') ?>') ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?= imageURL('favicon.ico') ?>">

</head>

<body class="hold-transition skin-blue sidebar-mini" dir="rtl">

<?php $this->beginBody() ?>
<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background: #FF6600;">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" style="color: white"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav mr-auto-navbav">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#" style="color: white">
                    <img style="height: 30px;" src="<?= user()->imageUrl ?>" class="user-image" alt="User Image">
                    <span class="hidden-xs"><?= user()->fullname ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="<?= Yii::$app->urlManager->createUrl("/user/profile") ?>" class="dropdown-item">
                        <i class="fas fa-user mr-2"></i>  <?= t('Profile') ?>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="<?= Yii::$app->urlManager->createUrl("/user/auth/logout") ?>" class="dropdown-item">
                        <i class="fa fa-sign-out mr-2"></i> <?= t('Sign out') ?>
                    </a>
                    <div class="dropdown-divider"></div>
                </div>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="<?= Yii::$app->urlManager->createUrl("/") ?>" class="brand-link" style="padding: 5px 26px;background: #FF6600;">
            <img src="<?= imageURL('') ?>" alt="Painter Logo" class="">
        </a>
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item <?php
                    if ($liActive == 1) {
                        echo 'active';
                    }
                    ?>">
                        <a class="nav-link <?php
                        if ($liActive == 1) {
                            echo 'active';
                        }
                        ?>" href="<?= Yii::$app->urlManager->createUrl("/") ?>">
                            <i class="fa fa-th"></i> <span><?= t('Dashboard') ?></span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>

                    <?php if (Admin::hasGroupPermission('painting')
                        || Admin::hasGroupPermission('tool')
                    ) { ?>
                        <li class="nav-item has-treeview <?php
                        if ($liActive == 'painting' || $liActive == 'tool') {
                            echo ' menu-open';
                        }
                        ?>">
                            <a href="#" style="padding-right: 3%;" class="nav-link <?php
                            if ($liActive == 'product') {
                                echo ' active';
                            }
                            ?>">
                                <i class="nav-icon fa fa-tags"></i>
                                <p>
                                    <?= t('Products') ?>
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <?php if (Admin::hasPermission('painting_index')) { ?>
                                    <li class="nav-item">
                                        <a href="<?= Yii::$app->urlManager->createUrl("/product/index?t=".PaintingToolType::painting) ?>" class="nav-link <?php
                                        if ($liinActive == 'painting') {
                                            echo 'active';
                                        }
                                        ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p><?= t('Paintings') ?></p>
                                        </a>
                                    </li>
                                <?php } ?>
                                <?php if (Admin::hasPermission('tool_index')) { ?>
                                    <li class="nav-item">
                                        <a href="<?= Yii::$app->urlManager->createUrl("/product/index?t=".PaintingToolType::tool) ?>" class="nav-link <?php
                                        if ($liinActive == 'tool') {
                                            echo 'active';
                                        }
                                        ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p><?= t('Tools') ?></p>
                                        </a>
                                    </li>
                                <?php } ?>

                            </ul>
                        </li>
                    <?php } ?>

                    <?php if (Admin::hasGroupPermission('place')) { ?>
                        <li class="nav-item has-treeview <?php
                        if ($liActive == 'course' || $liActive == 'hall' || $liActive == 'package' ) {
                            echo ' menu-open';
                        }
                        ?>">
                            <a href="#" style="padding-right: 3%;" class="nav-link <?php
                            if ($liActive == 'places and tickets') {
                                echo ' active';
                            }
                            ?>">
                                <i class="nav-icon fa fa-tags"></i>
                                <p>
                                    <?= t('Places and Tickets') ?>
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <?php if (Admin::hasPermission('course_index')) { ?>
                                    <li class="nav-item">
                                        <a href="<?= Yii::$app->urlManager->createUrl("/place/index?t=".PlaceType::course) ?>" class="nav-link <?php
                                        if ($liinActive == 'course') {
                                            echo 'active';
                                        }
                                        ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p><?= t('Courses') ?></p>
                                        </a>
                                    </li>
                                <?php } ?>
                                <?php if (Admin::hasPermission('hall_index')) { ?>
                                    <li class="nav-item">
                                        <a href="<?= Yii::$app->urlManager->createUrl("/place/index?t=".PlaceType::hall) ?>" class="nav-link <?php
                                        if ($liinActive == 'hall') {
                                            echo 'active';
                                        }
                                        ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p><?= t('Halls') ?></p>
                                        </a>
                                    </li>
                                <?php } ?>
                                <?php if (Admin::hasPermission('package_index')) { ?>
                                    <li class="nav-item">
                                        <a href="<?= Yii::$app->urlManager->createUrl("/place/index?t=".PlaceType::package) ?>" class="nav-link <?php
                                        if ($liinActive == 'package') {
                                            echo 'active';
                                        }
                                        ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p><?= t('Packages') ?></p>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>




                    <?php if (Admin::hasGroupPermission('common-question')) { ?>
                        <li class="nav-item <?php
                        if ($liActive == 'common-question') {
                            echo 'active';
                        }
                        ?>">
                            <a class="nav-link <?php
                            if ($liActive == 'app-info') {
                                echo 'active';
                            }
                            ?>" href="<?= Yii::$app->urlManager->createUrl("/common-question/index") ?>">
                                <i class="fa fa-cogs"></i> <span><?= t('Common Questions') ?></span>
                                <span class="pull-right-container"></span>
                            </a>
                        </li>
                    <?php } ?>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"><?= $this->title ?></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="<?= Yii::$app->urlManager->createUrl("/") ?>">
                                    <?=t('Home') ?>
                                </a>
                            </li>
                            <li class="breadcrumb-item active"><?= $this->title ?></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <?php if (Yii::$app->session->hasFlash('flash_error')): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= Yii::$app->session->getFlash('flash_error'); ?>
                    </div>
                <?php endif; ?>
                <?php if (Yii::$app->session->hasFlash('flash_warning')): ?>
                    <div class="alert alert-warning" role="alert">
                        <?= Yii::$app->session->getFlash('flash_warning'); ?>
                    </div>
                <?php endif; ?>
                <?php if (Yii::$app->session->hasFlash('flash_success')): ?>
                    <div class="alert alert-success" role="alert">
                        <?= Yii::$app->session->getFlash('flash_success'); ?>
                    </div>
                <?php endif; ?>
                <?= $content ?>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <footer class="main-footer">
        <strong><?= t('Copyright') ?> &copy; 2020 <b>IT Space</b></strong>
        <?= t('All rights reserved.') ?>
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0
        </div>
    </footer>
</div>

<div class="modal fade" id="myModal" data-loading="<?= t( 'Loading...') ?>"
     data-close="<?= \Yii::t('all', 'Close') ?>" tabindex="-1" aria-labelledby="myModalLabel" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog" id="modalContent" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <?= t( 'Loading...') ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style=""><?= t( 'Close') ?></button>
            </div>
        </div>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<script>
    var url = <?= json_encode(yii\helpers\BaseUrl::base()) ?>;
    var lang = <?= json_encode(Yii::$app->language) ?>;
</script>


<?php
//$this->registerCssFile('@web/css/docs.css');
//$this->registerCssFile('@web/css/highligher.css');
$this->registerCssFile('@web/css/all.min.css');
$this->registerCssFile('@web/css/tempusdominus-bootstrap-4.min.css');
$this->registerCssFile('@web/css/icheck-bootstrap.min.css');
$this->registerCssFile('@web/css/jqvmap.min.css');
$this->registerCssFile('@web/css/adminlte.min.css');
$this->registerCssFile('@web/css/OverlayScrollbars.min.css');
$this->registerCssFile('@web/css/daterangepicker.css');
$this->registerCssFile('@web/css/summernote-bs4.css');
$this->registerCssFile('@web/css/custom/custom.css');

?>
