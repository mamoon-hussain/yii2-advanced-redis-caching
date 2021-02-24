<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace api\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class DashboardAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.css',
        'font-awesome/4.5.0/css/font-awesome.min.css',
        'css/fonts.googleapis.com.css',
        'css/ace.min.css',
        'css/ace-skins.min.css',
        'css/ace-rtl.min.css',
        'css/notification/notifIt.css',
        'css/hover.css',
        'css/style.css'

    ];
    public $js = [
        'js/ace-extra.min.js',
        'js/bootstrap.min.js',
        'js/jquery-ui.custom.min.js',
        'js/jquery.ui.touch-punch.min.js',
        'js/jquery.easypiechart.min.js',
        'js/jquery.sparkline.index.min.js',
        'js/jquery.flot.min.js',
        'js/jquery.flot.pie.min.js',
        'js/jquery.flot.resize.min.js',
        'js/ace-elements.min.js',
        'js/ace.min.js',
        'js/status.js',
        'js/notification/notifIt.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
            //'yii\bootstrap\BootstrapAsset',
    ];

}
