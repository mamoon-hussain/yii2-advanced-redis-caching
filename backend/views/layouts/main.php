<?php
/* @var $this \yii\web\View */

/* @var $content string */

use backend\assets\DashboardAsset;
use backend\assets\DashboardRtLAsset;
use backend\assets\DashboardLtRAsset;
use yii\helpers\Html;
use common\models\Admin;
use yii\helpers\Url;
use common\enums\PaintingToolType;
use common\enums\PlaceType;
use common\models\Notification;

$liActive = viewParam('liActive', '');
$liinActive = viewParam('liinActive', '');
$liininActive = viewParam('liininActive', '');
if (Yii::$app->language == "en") {
    DashboardLtRAsset::register($this);
} else if (Yii::$app->language == "ar") {
    DashboardRtLAsset::register($this);
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
    if (Yii::$app->language == "en") {
        DashboardLtRAsset::register($this);
    } else if (Yii::$app->language == "ar") {
        DashboardRtLAsset::register($this);
    }
    ?>
    <?= Html::csrfMetaTags() ?>
    <link rel="apple-touch-icon" href="<?= imageURL('apple-icon-120.png') ?>') ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?= imageURL('favicon.ico') ?>">

</head>

<!--<body class="hold-transition skin-blue sidebar-mini" dir="rtl">-->
<body class="hold-transition skin-blue sidebar-mini <?= Yii::$app->language == "ar" ? "rtl" : "" ?>">

<?php $this->beginBody() ?>
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fa fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav <?php
        if(Yii::$app->language != 'ar'){
            echo 'ml-auto';
        } else {
            echo 'mr-auto-navbav';
        }
        ?> ">
            <?php
            $notificationsCount = Notification::find()
                ->andWhere(['user_id' => userId()])
                ->andWhere(['is_read' => 0])
                ->count();
            $latestNotifications = Notification::find()
                ->andWhere(['user_id' => userId()])
                ->andWhere(['is_read' => 0])
                ->limit(5)
                ->all();
            ?>
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="true">
                    <i class="fa fa-bell"></i>
                    <?php if($notificationsCount){ ?>
                        <span class="badge badge-warning navbar-badge"><?= $notificationsCount ?></span>
                    <?php } ?>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header"><?php $notificationsCount.' ' .t('Notification') ?></span>
                    <div class="dropdown-divider"></div>
                    <?php foreach ($latestNotifications as $one) { ?>
                        <a href="<?= Yii::$app->urlManager->createUrl("/request/view?id=$one->data_id") ?>" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> <?= t($one->body) ?>
                            <span class="float-right text-muted text-sm">
                                <?= date('d/M', strtotime($one->create_date)) ?>
                            </span>
                        </a>
                        <div class="dropdown-divider"></div>
                    <?php } ?>
                    <a href="<?= Yii::$app->urlManager->createUrl("/notification") ?>" class="dropdown-item dropdown-footer">
                        <?= t('See All Notifications') ?>
                    </a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <?php if (Yii::$app->language != 'ar') { ?>
                    <a class="nav-link" style="height: 100%; line-height: 32px;"
                       href="<?= Yii::$app->urlManager->createUrl("/site/lang?l=ar") ?>">
                        <?= t('العربية') ?>
                    </a>
                <?php } else { ?>
                    <a class="nav-link" style="height: 100%; line-height: 32px;"
                       href="<?= Yii::$app->urlManager->createUrl("/site/lang?l=en") ?>">
                        <?= t('English') ?>
                    </a>
                <?php } ?>
            </li>
            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
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
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="<?= Yii::$app->urlManager->createUrl("/") ?>" class="brand-link" style="padding: 5px 26px;background: #3c8dbc;">
            <img  style="max-height: 46px;" src="<?= imageURL('painter.png') ?>" alt="Painter Logo" class="">
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

<!--                    --><?php //if (Admin::hasGroupPermission('product')
//                    ) { ?>
<!--                        <li class="nav-item has-treeview --><?php
//                        if ($liinActive == 'painting' || $liinActive == 'tool') {
//                            echo ' menu-open';
//                        }
//                        ?><!--">-->
<!--                            <a href="#" style="padding-right: 3%;" class="nav-link --><?php
//                            if ($liActive == 'product') {
//                                echo ' active';
//                            }
//                            ?><!--">-->
<!--                                <i class="nav-icon fa fa-product-hunt"></i>-->
<!--                                <p>-->
<!--                                    --><?php //= t('Products') ?>
<!--                                    <i class="fa fa-angle-left right"></i>-->
<!--                                </p>-->
<!--                            </a>-->
<!--                            <ul class="nav nav-treeview">-->
<!--                                --><?php //if (Admin::hasPermission('painting_index')) { ?>
<!--                                    <li class="nav-item">-->
<!--                                        <a href="--><?php //= Yii::$app->urlManager->createUrl("/product/index?t=".PaintingToolType::painting) ?><!--" class="nav-link --><?php
//                                        if ($liinActive == 'painting') {
//                                            echo 'active';
//                                        }
//                                        ?><!--">-->
<!--                                            <i class="far fa-circle nav-icon"></i>-->
<!--                                            <p>--><?php //= t('Paintings') ?><!--</p>-->
<!--                                        </a>-->
<!--                                    </li>-->
<!--                                --><?php //} ?>
<!--                                --><?php //if (Admin::hasPermission('tool_index')) { ?>
<!--                                    <li class="nav-item">-->
<!--                                        <a href="--><?php //= Yii::$app->urlManager->createUrl("/product/index?t=".PaintingToolType::tool) ?><!--" class="nav-link --><?php
//                                        if ($liinActive == 'tool') {
//                                            echo 'active';
//                                        }
//                                        ?><!--">-->
<!--                                            <i class="far fa-circle nav-icon"></i>-->
<!--                                            <p>--><?php //= t('Tools') ?><!--</p>-->
<!--                                        </a>-->
<!--                                    </li>-->
<!--                                --><?php //} ?>
<!--                            </ul>-->
<!--                        </li>-->
<!--                    --><?php //} ?>



<!--                    --><?php //if (Admin::hasGroupPermission('place')
//                    ) { ?>
<!--                        <li class="nav-item has-treeview --><?php
//                        if ($liinActive == 'course' || $liinActive == 'hall' || $liinActive == 'package' ) {
//                            echo ' menu-open';
//                        }
//                        ?><!--">-->
<!--                            <a href="#" style="padding-right: 3%;" class="nav-link --><?php
//                            if ($liActive == 'places and tickets') {
//                                echo ' active';
//                            }
//                            ?><!--">-->
<!--                                <i class="nav-icon fa fa-building"></i>-->
<!--                                <p>-->
<!--                                    --><?php //= t('Places and Tickets') ?>
<!--                                    <i class="fa fa-angle-left right"></i>-->
<!--                                </p>-->
<!--                            </a>-->
<!--                            <ul class="nav nav-treeview">-->
<!--                                --><?php //if (Admin::hasPermission('course_index')) { ?>
<!--                                    <li class="nav-item">-->
<!--                                        <a href="--><?php //= Yii::$app->urlManager->createUrl("/place/index?t=".PlaceType::course) ?><!--" class="nav-link --><?php
//                                        if ($liinActive == 'course') {
//                                            echo 'active';
//                                        }
//                                        ?><!--">-->
<!--                                            <i class="far fa-circle nav-icon"></i>-->
<!--                                            <p>--><?php //= t('Courses') ?><!--</p>-->
<!--                                        </a>-->
<!--                                    </li>-->
<!--                                --><?php //} ?>
<!--                                --><?php //if (Admin::hasPermission('hall_index')) { ?>
<!--                                    <li class="nav-item">-->
<!--                                        <a href="--><?php //= Yii::$app->urlManager->createUrl("/place/index?t=".PlaceType::hall) ?><!--" class="nav-link --><?php
//                                        if ($liinActive == 'hall') {
//                                            echo 'active';
//                                        }
//                                        ?><!--">-->
<!--                                            <i class="far fa-circle nav-icon"></i>-->
<!--                                            <p>--><?php //= t('Art Classes') ?><!--</p>-->
<!--                                        </a>-->
<!--                                    </li>-->
<!--                                --><?php //} ?>
<!--                                --><?php //if (Admin::hasPermission('package_index')) { ?>
<!--                                    <li class="nav-item">-->
<!--                                        <a href="--><?php //= Yii::$app->urlManager->createUrl("/place/index?t=".PlaceType::package) ?><!--" class="nav-link --><?php
//                                        if ($liinActive == 'package') {
//                                            echo 'active';
//                                        }
//                                        ?><!--">-->
<!--                                            <i class="far fa-circle nav-icon"></i>-->
<!--                                            <p>--><?php //= t('Art Tables') ?><!--</p>-->
<!--                                        </a>-->
<!--                                    </li>-->
<!--                                --><?php //} ?>
<!--                            </ul>-->
<!--                        </li>-->
<!--                    --><?php //} ?>

                    <?php if (Admin::hasGroupPermission('category')) { ?>
                        <li class="nav-item <?php
                        if ($liActive == 'category') {
                            echo 'active';
                        }
                        ?>">
                            <a class="nav-link <?php
                            if ($liActive == 'category') {
                                echo 'active';
                            }
                            ?>" href="<?= Yii::$app->urlManager->createUrl("/category/index") ?>">
                                <i class="fa fa-tags"></i> <span><?= t('Categories') ?></span>
                                <span class="pull-right-container"></span>
                            </a>
                        </li>
                    <?php } ?>


                    <?php if (Admin::hasGroupPermission('post')) { ?>
                        <li class="nav-item <?php
                        if ($liActive == 'post') {
                            echo 'active';
                        }
                        ?>">
                            <a class="nav-link <?php
                            if ($liActive == 'post') {
                                echo 'active';
                            }
                            ?>" href="<?= Yii::$app->urlManager->createUrl("/post/index") ?>">
                                <i class="fa fa-tags"></i> <span><?= t('Posts') ?></span>
                                <span class="pull-right-container"></span>
                            </a>
                        </li>
                    <?php } ?>

<!--                    --><?php //if (Admin::hasGroupPermission('comment')) { ?>
<!--                        <li class="nav-item --><?php
//                        if ($liActive == 'comment') {
//                            echo 'active';
//                        }
//                        ?><!--">-->
<!--                            <a class="nav-link --><?php
//                            if ($liActive == 'comment') {
//                                echo 'active';
//                            }
//                            ?><!--" href="--><?php //= Yii::$app->urlManager->createUrl("/comment/index") ?><!--">-->
<!--                                <i class="fa fa-tags"></i> <span>--><?php //= t('Comments') ?><!--</span>-->
<!--                                <span class="pull-right-container"></span>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                    --><?php //} ?>

                    <?php if (false && Admin::hasGroupPermission('common-question')) { ?>
                        <li class="nav-item <?php
                        if ($liActive == 'common-question') {
                            echo 'active';
                        }
                        ?>">
                            <a class="nav-link <?php
                            if ($liActive == 'common-question') {
                                echo 'active';
                            }
                            ?>" href="<?= Yii::$app->urlManager->createUrl("/common-question/index") ?>">
                                <i class="fa fa-question"></i> <span><?= t('Common Question') ?></span>
                                <span class="pull-right-container"></span>
                            </a>
                        </li>
                    <?php } ?>


<!--                    --><?php //if (Admin::hasGroupPermission('app-info')) { ?>
<!--                        <li class="nav-item --><?php
//                        if ($liActive == 'app-info') {
//                            echo 'active';
//                        }
//                        ?><!--">-->
<!--                            <a class="nav-link --><?php
//                            if ($liActive == 'app-info') {
//                                echo 'active';
//                            }
//                            ?><!--" href="--><?php //= Yii::$app->urlManager->createUrl("/app-info") ?><!--">-->
<!--                                <i class="fa fa-cogs"></i> <span>--><?php //= t('App Info') ?><!--</span>-->
<!--                                <span class="pull-right-container"></span>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                    --><?php //} ?>

<!--                    --><?php //if (Admin::hasGroupPermission('terms')) { ?>
<!--                        <li class="nav-item --><?php
//                        if ($liActive == 'terms') {
//                            echo 'active';
//                        }
//                        ?><!--">-->
<!--                            <a class="nav-link --><?php
//                            if ($liActive == 'terms') {
//                                echo 'active';
//                            }
//                            ?><!--" href="--><?php //= Yii::$app->urlManager->createUrl("/terms") ?><!--">-->
<!--                                <i class="fa fa-cogs"></i> <span>--><?php //= t('Terms & Conditions') ?><!--</span>-->
<!--                                <span class="pull-right-container"></span>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                    --><?php //} ?>

<!--                    --><?php //if (Admin::hasGroupPermission('request')) { ?>
<!--                        <li class="nav-item --><?php
//                        if ($liActive == 'request') {
//                            echo 'active';
//                        }
//                        ?><!--">-->
<!--                            <a class="nav-link --><?php
//                            if ($liActive == 'request') {
//                                echo 'active';
//                            }
//                            ?><!--" href="--><?php //= Yii::$app->urlManager->createUrl("/request") ?><!--">-->
<!--                                <i class="fa fa-hourglass-start"></i> <span>--><?php //= t('Requests') ?><!--</span>-->
<!--                                <span class="pull-right-container"></span>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                    --><?php //} ?>

                    <?php if (false && Admin::hasGroupPermission('admin')) { ?>
                        <li class="nav-item has-treeview <?php
                        if ($liActive == 'admins') {
                            echo ' menu-open';
                        }
                        ?>">
                            <a href="#" style="padding-right: 3%;" class="nav-link <?php
                            if ($liActive == 'admins') {
                                echo ' active';
                            }
                            ?>">
                                <i class="nav-icon fa fa-users"></i>
                                <p>
                                    <?= t('Admin Manage') ?>
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <?php if (Admin::hasPermission('admin_index')) { ?>
                                    <li class="nav-item">
                                        <a href="<?= Yii::$app->urlManager->createUrl("/user/admin/index") ?>" class="nav-link <?php
                                        if ($liinActive == 'admins_all') {
                                            echo 'active';
                                        }
                                        ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p><?= t('All') ?></p>
                                        </a>
                                    </li>
                                <?php } ?>
                                <?php if (Admin::hasPermission('role')) { ?>
                                    <li class="nav-item">
                                        <a href="<?= Yii::$app->urlManager->createUrl("/user/role") ?>" class="nav-link <?php
                                        if ($liinActive == 'role') {
                                            echo 'active';
                                        }
                                        ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p><?= t('Roles') ?></p>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>

<!--                    --><?php //if (Admin::hasPermission('contact-us_index')) { ?>
<!--                        <li class="nav-item --><?php
//                        if ($liActive == 'contact-us') {
//                            echo 'active';
//                        }
//                        ?><!--">-->
<!--                            <a class="nav-link --><?php
//                            if ($liActive == 'contact-us') {
//                                echo 'active';
//                            }
//                            ?><!--" href="--><?php //= Yii::$app->urlManager->createUrl("/contact-us") ?><!--">-->
<!--                                <i class="fa fa-support"></i> <span>--><?php //= t('Contact Us Requests') ?><!--</span>-->
<!--                                <span class="pull-right-container"></span>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                    --><?php //} ?>

<!--                    --><?php //if (Admin::hasPermission('site_confirmation-codes')) { ?>
<!--                        <li class="nav-item --><?php
//                        if ($liActive == 'confirmation-codes') {
//                            echo 'active';
//                        }
//                        ?><!--">-->
<!--                            <a class="nav-link --><?php
//                            if ($liActive == 'confirmation-codes') {
//                                echo 'active';
//                            }
//                            ?><!--" href="--><?php //= Yii::$app->urlManager->createUrl("/site/confirmation-codes") ?><!--">-->
<!--                                <i class="fa fa-code"></i> <span>--><?php //= t('Confirmation Codes') ?><!--</span>-->
<!--                                <span class="pull-right-container"></span>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                    --><?php //} ?>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
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
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong><?= t('Copyright') ?> &copy; 2020</strong>
        <?= t('All rights reserved.') ?>
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
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
