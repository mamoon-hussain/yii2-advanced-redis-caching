<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CommonQuestion */

$this->title = t('Update Question');
$this->params['breadcrumbs'][] = ['label' => 'Common Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
setViewParam('liActive', 'common-question');
?>
<div class="common-question-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
