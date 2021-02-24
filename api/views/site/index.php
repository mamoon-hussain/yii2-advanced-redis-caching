<?php
/* @var $this yii\web\View */
setViewParam('liActive', 1);
$this->title = t(Yii::$app->params['title']);
?>
<div class="page-header">
    <h1>
        <?= $this->title; ?>
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            <?= t('Welcome') ?>
        </small>
    </h1>
</div>

