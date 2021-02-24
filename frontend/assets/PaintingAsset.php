<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class PaintingAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

        'css/tether.min.css',

        'css/bootstrap.min.css',
        'css/bootstrap-grid.min.css',
        'css/bootstrap-reboot.min.css',
        'css/bootstrap-reboot.min.css',
        'css/jquery.formstyler.css',
        'css/jquery.formstyler.theme.css',
        'css/style.css',
        'css/animate.css',
        'css/styles.css',
        'css/style1.css',
        'css/mbr-additional.css',



    ];
    public $js = [

        'js/jquery.min.js',
//        'popper/popper.min.js',
        'js/popper.min.js',
//        'tether/tether.min.js',
        'js/tether.min.js',
        'bootstrap/js/bootstrap.min.js',
//        'smoothscroll/smooth-scroll.js',
        'js/smooth-scroll.js',
        'js/nav-dropdown.js',
        'js/navbar-dropdown.js',
//        'touchswipe/jquery.touch-swipe.min.js',
        'js/jquery.touch-swipe.min.js',
//        'viewportchecker/jquery.viewportchecker.js',
        'js/jquery.viewportchecker.js',
//        'parallax/ja?rallax.min.js',
        'js/jarallax.min.js',
//        'theme/js/script.js',

//        'js/formoid.min.js',
//        'js/jquery.datetimepicker.full.js',
        'js/jquery.formstyler.js',
        'js/jquery.formstyler.min.js',
//        'js/jquery.min.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
            //'yii\bootstrap\BootstrapAsset',
    ];

}
