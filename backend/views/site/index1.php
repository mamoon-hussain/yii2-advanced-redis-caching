<?php
/* @var $this yii\web\View */

use yii\web\View;
use common\enums\OrderStatus;

setViewParam('liActive', 1);
$this->title = Yii::t('all', Yii::$app->params['title']) . ' ' .Yii::t('all','Dashboard');
?>