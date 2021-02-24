<?php

use yii\helpers\Html;
use common\enums\PlaceType;

/* @var $this yii\web\View */
/* @var $model common\models\Place */


$this->params['breadcrumbs'][] = ['label' => 'Places', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
setViewParam('liActive', 'places and tickets');
switch ($type) {
    case PlaceType::course:
        $this->title = t('Create Course');
        break;

    case PlaceType::hall:
        $this->title = t('Create Art Class');
        break;

    case PlaceType::package:
        $this->title = t('Create Art Table');
        break;
} ?>

<div class="place-create">

    <?= $this->render('_form', [
        'model' => $model,
        'type' => $type,
    ]) ?>

</div>
