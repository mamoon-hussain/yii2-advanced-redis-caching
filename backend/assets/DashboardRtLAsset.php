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
class DashboardRtLAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [


        'plugins/fontawesome-free/css/all.min.css',
//        'css/ionicons.min.css',
        'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css',
        'plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css',
        'plugins/icheck-bootstrap/icheck-bootstrap.min.css',
        'plugins/jqvmap/jqvmap.min.css',
        'dist/css/adminlte.min.css',
        'plugins/overlayScrollbars/css/OverlayScrollbars.min.css',
        'plugins/daterangepicker/daterangepicker.css',
        'plugins/summernote/summernote-bs4.css',
        'css/fonts.css',
        'css/bootstrap.min.css',
//        'https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css',
        'dist/css/custom.css',

        'bower_components/font-awesome/css/font-awesome.min.css',
        'css/notification/notifIt.css',
        'css/custom/custom.css',
    ];
    public $js = [

        'js/bootstrap.min.js',
        'plugins/bootstrap/js/bootstrap.bundle.min.js',
        'plugins/chart.js/Chart.min.js',
        'plugins/sparklines/sparkline.js',
        'plugins/jqvmap/jquery.vmap.min.js',
        'plugins/jqvmap/maps/jquery.vmap.world.js',
        'plugins/jquery-knob/jquery.knob.min.js',
        'plugins/moment/moment.min.js',
        'plugins/daterangepicker/daterangepicker.js',
        'plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',
        'plugins/summernote/summernote-bs4.min.js',
        'plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js',
        'dist/js/adminlte.js',

//        'dist/js/pages/dashboard.js',
        'dist/js/demo.js',


        'js/notification/notifIt.js',
        'js/custom/modal.js',
        'js/custom/select_all.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];

}
