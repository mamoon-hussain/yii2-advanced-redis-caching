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
class DashboardAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
//        'bower_components/bootstrap/dist/css/bootstrap.min.css',
//        'bower_components/font-awesome/css/font-awesome.min.css',
//        'bower_components/Ionicons/css/ionicons.min.css',
//        'dist/css/AdminLTE.min.css',
//        'dist/css/skins/_all-skins.css',
//        'bower_components/morris.js/morris.css',
//        'bower_components/jvectormap/jquery-jvectormap.css',
//        'bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
//        'bower_components/bootstrap-daterangepicker/daterangepicker.css',
//        'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
//        'fonts/fonts.css',




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
//        'bower_components/jquery/dist/jquery.min.js',
//        'bower_components/jquery-ui/jquery-ui.min.js',
//        'bower_components/bootstrap/dist/js/bootstrap.min.js',
//        'bower_components/raphael/raphael.min.js',
//        'bower_components/morris.js/morris.min.js',
//        'bower_components/jquery-sparkline/dist/jquery.sparkline.min.js',
//        'plugins/jvectormap/jquery-jvectormap-1.2.2.min.js',
//        'plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
//        'bower_components/jquery-knob/dist/jquery.knob.min.js',
//        'bower_components/moment/min/moment.min.js',
//        'bower_components/bootstrap-daterangepicker/daterangepicker.js',
//        'bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
//        'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
//        'bower_components/jquery-slimscroll/jquery.slimscroll.min.js',
//        'bower_components/fastclick/lib/fastclick.js',
//        'dist/js/adminlte.min.js',
////        'dist/js/pages/dashboard.js',
//        'dist/js/demo.js',

        'js/bootstrap.min.js',
//        'plugins/bootstrap/js/bootstrap.bundle.min.js',
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
