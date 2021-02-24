<?php

use webvimark\modules\UserManagement\components\GhostHtml;
use webvimark\modules\UserManagement\models\rbacDB\Role;
use webvimark\modules\UserManagement\models\ZUser;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\ZUser $model
 */
$this->title = $model->username;

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <div class="panel panel-default">
        <div class="panel-body">

            <p>
                <?= Html::a(t('Update'), ['update'], ['class' => 'btn btn-sm btn-primary']) ?>
                <?php Html::a('Change Password', ['change-own-password'], ['class' => 'btn btn-sm btn-warning']) ?>
            </p>


            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
//                    'id',
                    [
                        'attribute' => 'status',
                        'value' => ZUser::getStatusValue($model->status),
                    ],
                    'username',
                    // 'fname',
                    [
                        'attribute' => 'fname',
                        'value' => $model->fname,
                    ],
                    // 'lname',
                    [
                        'attribute' => 'lname',
                        'value' => $model->lname,
                    ],
                    [
                        'attribute' => 'email',
                        'value' => $model->email,
                    ],
                    'created_at:datetime',
//                    'updated_at:datetime',
                ],
            ])
            ?>

        </div>
    </div>
</div>
