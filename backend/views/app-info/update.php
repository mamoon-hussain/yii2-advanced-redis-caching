<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Area */

$this->title = t('Edit App Info');
$this->params['breadcrumbs'][] = Yii::t('all', 'Update');
setViewParam('liActive', 'help');
setViewParam('liinActive', 'app-info');
setViewParam('liininActive', 'app-info');
\yii\web\YiiAsset::register($this);
?>


<div class="panel panel-default">
    <div class="panel-body">

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
