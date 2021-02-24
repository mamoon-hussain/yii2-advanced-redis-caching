<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PlaceContents */

$this->title = 'Update Place Contents: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Place Contents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="place-contents-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
