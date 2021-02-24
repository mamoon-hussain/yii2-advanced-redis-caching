<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class DashboardLtRAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'plugins/fontawesome-free/css/all.min.css',
////        'css/ionicons.min.css',
//        'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css',
//        'plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css',
//        'plugins/icheck-bootstrap/icheck-bootstrap.min.css',
//        'plugins/jqvmap/jqvmap.min.css',
//        'dist/css/adminlte.min.css',
//        'plugins/overlayScrollbars/css/OverlayScrollbars.min.css',
//        'plugins/daterangepicker/daterangepicker.css',
//        'plugins/summernote/summernote-bs4.css',
//        'css/fonts.css',
//        'css/bootstrap.min.css',
//        'https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css',
//        'dist/css/custom.css',

//        'css/custom/all.min.css', //true
        'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css',
        'css/custom/tempusdominus-bootstrap-4.min.css',
        'css/custom/icheck-bootstrap.min.css',
        'css/custom/jqvmap.min.css',
        'css/custom/adminlte.min.css',
        'css/custom/OverlayScrollbars.min.css',
        'plugins/daterangepicker/daterangepicker.css',
        'css/custom/daterangepicker.css',
        'css/custom/summernote-bs4.css',
        'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700',
        'bower_components/font-awesome/css/font-awesome.min.css',

        'css/custom/custom.css',






    ];
    public $js = [

//        'js/custom/jquery.min.js',
        'js/custom/jquery-ui.min.js',
        'plugins/bootstrap/js/bootstrap.bundle.min.js',
        'js/custom/Chart.min.js',
        'js/custom/sparkline.js',
        'js/custom/jquery.vmap.min.js',
        'js/custom/jquery.vmap.usa.js',
        'js/custom/jquery.knob.min.js',
        'js/custom/moment.min.js',
        'plugins/daterangepicker/daterangepicker.js',
        'js/custom/tempusdominus-bootstrap-4.min.js',
        'js/custom/summernote-bs4.min.js',
        'js/custom/jquery.overlayScrollbars.min.js',
        'js/custom/adminlte.js',
//        'js/custom/dashboard.js',
        'js/custom/demo.js',

        'js/notification/notifIt.js',
        'js/custom/modal.js',
        'js/custom/select_all.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}