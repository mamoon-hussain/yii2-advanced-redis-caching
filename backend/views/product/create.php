<?php

use yii\helpers\Html;
use common\enums\PaintingToolType;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
setViewParam('liActive', 'product');
switch ($type) {
    case PaintingToolType::painting:
        $this->title = t('Create Painting');
        break;

    case PaintingToolType::tool:
        $this->title = t('Create Tool');
        break;
}
?>

<div class="product-create">

    <?= $this->render('_form', [
        'model' => $model,
        'type' => $type,

    ]) ?>

</div>
