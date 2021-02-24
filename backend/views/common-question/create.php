<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CommonQuestion */

$this->title = t('Create Question');
$this->params['breadcrumbs'][] = ['label' => 'Common Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="common-question-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
