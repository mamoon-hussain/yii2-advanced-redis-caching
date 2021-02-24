<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = t('Update: ') . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
setViewParam('liActive', 'product');
?>
<div class="product-update">


    <?= $this->render('_form', [
        'model' => $model,
        'type' => $type,
    ]) ?>

</div>
