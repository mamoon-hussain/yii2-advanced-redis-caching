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
class loginAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'bower_components/bootstrap/dist/css/bootstrap.min.css',
        'bower_components/font-awesome/css/font-awesome.min.css',
        'bower_components/Ionicons/css/ionicons.min.css',
        'dist/dist_ltr/css/AdminLTE.min.css',
        'plugins/iCheck/square/blue.css',

        'css/custom/style.css',
    ];
    public $js = [
//        'bower_components/jquery/dist/jquery.min.js',
        'bower_components/bootstrap/dist/js/bootstrap.min.js',
        'plugins/iCheck/icheck.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
//            'yii\bootstrap\BootstrapAsset',
    ];

}
