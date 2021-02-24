<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Notification */

$this->title = t('Update');
$this->params['breadcrumbs'][] = ['label' => 'Notifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
setViewParam('liActive', 'notification');
setViewParam('liinActive', 'notification');
?>
<div class="notification-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
