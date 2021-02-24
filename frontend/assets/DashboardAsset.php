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
class DashboardAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

        'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css',
        'org_layout/web/assets/mobirise-icons2/mobirise2.css',
        'org_layout/tether/tether.min.css',
        'org_layout/bootstrap/css/bootstrap.min.css',
        'org_layout/bootstrap/css/bootstrap-grid.min.css',
        'org_layout/bootstrap/css/bootstrap-reboot.min.css',
        'org_layout/dropdown/css/style.css',
        'org_layout/animatecss/animate.css',
        'org_layout/socicon/css/styles.css',
        'org_layout/theme/css/style.css',
        'org_layout/mobirise/css/mbr-additional.css',
        'org_layout/mobirise/css/mbr-additional.css',
//        'org_layout/datepicker/datepicker/css/datepicker.css',
        'https://use.fontawesome.com/releases/v5.15.1/css/all.css',

        'css/custom/custom.css',



    ];
    public $js = [
        'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js',
//        'org_layout/web/assets/jquery/jquery.min.js',
        'org_layout/popper/popper.min.js',
        'org_layout/tether/tether.min.js',
        'org_layout/bootstrap/js/bootstrap.min.js',
        'org_layout/smoothscroll/smooth-scroll.js',
        'org_layout/dropdown/js/nav-dropdown.js',
        'org_layout/dropdown/js/navbar-dropdown.js',
        'org_layout/touchswipe/jquery.touch-swipe.min.js',
        'org_layout/viewportchecker/jquery.viewportchecker.js',
        'org_layout/parallax/jarallax.min.js',
        'org_layout/theme/js/script.js',
//        'org_layout/datepicker/datepicker/js/bootstrap-datepicker.js',

        'js/custom/custom.js',
        'js/custom/modal.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];

}
