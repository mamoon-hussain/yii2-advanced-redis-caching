<?php


namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;


class CookiesAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
 ];
    
        public function init() {

        $this->jsOptions['position'] = View::POS_HEAD;
        $this->jsOptions['id'] = 'cookieinfo';
        $this->jsOptions['data-message'] = 'Wir verwenden Cookies, um Ihre Erfahrung zu verbessern. Wenn Sie diese Website weiterhin besuchen, erklären Sie sich mit der Verwendung von Cookies einverstanden.';
        $this->jsOptions['data-linkmsg'] = 'Mehr Informationen';
        $this->jsOptions['data-moreinfo'] = 'https://en.wikipedia.org/wiki/HTTP_cookie';

        parent::init();

    }
    public $js = [

        'js/cookieinfo.min.js',

    ];
    public $depends = [
             //'yii\bootstrap\BootstrapAsset',
    ];
 
}
