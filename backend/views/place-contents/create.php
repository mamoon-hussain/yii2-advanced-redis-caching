<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PlaceContents */

$this->title = 'Create Place Contents';
$this->params['breadcrumbs'][] = ['label' => 'Place Contents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="place-contents-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
