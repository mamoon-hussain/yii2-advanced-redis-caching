<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProductFrames */

$this->title = 'Update Product Frames: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Product Frames', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-frames-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
