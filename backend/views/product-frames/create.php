<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProductFrames */

$this->title = t('Create');
$this->params['breadcrumbs'][] = ['label' => 'Product Frames', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-frames-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
