<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */

$this->title = t('Terms & Conditions');
$this->params['breadcrumbs'][] = t( 'The Details');
setViewParam('liActive', 'terms');
\yii\web\YiiAsset::register($this);
?>




<div class="panel panel-default">
    <div class="panel-body">

        <p>
            <?= Html::a(t( 'Update'), ['update'], ['class' => 'btn btn-success']) ?>
            <?= Html::button(t( 'Localization'), [
                'class' => 'activity-view-link btn btn-primary',
//                'style' => 'border: none;background: transparent;color: #2782df;',
                'data-toggle' => 'modal',
                'data-target' => '#myModal',
                'value' => Yii::$app->urlManager->createUrl("/terms/localization")]) ?>

        </p>

        <div class="panel panel-default">
            <div class="panel-body">
                <h3><?= $model->getAttributeLabel('description') ?></h3>
                <?= $model->description ?>
            </div>
        </div>

    </div>
</div>
