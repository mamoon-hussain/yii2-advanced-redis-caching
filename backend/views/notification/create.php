<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Notification */

$this->title = t('Create');
$this->params['breadcrumbs'][] = ['label' => 'Notifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
setViewParam('liActive', 'notification');
setViewParam('liinActive', 'notification');
?>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="notification-create">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>
</div>
