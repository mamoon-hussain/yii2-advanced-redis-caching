<?php

use webvimark\modules\UserManagement\components\GhostHtml;
use webvimark\modules\UserManagement\models\rbacDB\Role;
use webvimark\modules\UserManagement\models\User;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\Pjax;
use webvimark\extensions\GridBulkActions\GridBulkActions;
use webvimark\extensions\GridPageSize\GridPageSize;
use yii\grid\GridView;

setViewParam('liActive', 'users');
setViewParam('liinActive', 'users_all');
/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var webvimark\modules\UserManagement\models\search\UserSearch $searchModel
 */
$this->title = t('all', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default">
    <div class="panel-body">
<div class="user-index">

    <?php //echo $this->render('_search', ['model' => $searchModel, 'action' => 'index']); ?>



            <div class="row">
                <div class="col-sm-6">
                    <p>
                        <?=
                        GhostHtml::a(
                                '<span class="glyphicon glyphicon-plus-sign"></span> ' . t('all', 'Create'), ['/user/user/create'], ['class' => 'btn btn-sm btn-success']
                        )
                        ?>
                    </p>
                </div>

                <div class="col-sm-6 text-right">
                    <?= GridPageSize::widget(['pjaxId' => 'user-grid-pjax']) ?>
                </div>
            </div>



            <?=
            GridView::widget([
                'id' => 'user-grid',
                'filterModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'pager' => [
                    'options' => ['class' => 'pagination pagination-sm'],
                    'hideOnSinglePage' => true,
                    'lastPageLabel' => '>>',
                    'firstPageLabel' => '<<',
                ],
//                'filterModel' => $searchModel,
//                'layout' => '{items}',
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn', 'options' => ['style' => 'width:10px']],
                    [
                        'attribute' => 'email',
                        'value' => function($model) {
                            return Html::a($model->email, ['view', 'id' => $model->id], ['data-pjax' => 0]);
                        },
                                'format' => 'raw',
                            ],
                            [
                                'attribute' => 'username',
                                'format' => 'raw',
                            ],
                            [
                                'attribute' => 'fname',
                                'format' => 'raw',
                            ],
                            [
                                'attribute' => 'phone',
                                'format' => 'raw',
                            ],
//                            [
//                                'label' => 'Fees',
//                                'value' => function($model) {
//                                    $btn = Html::a('Inland Fees', ['/inland-fees', 'id' => $model->id], ['class' => 'btn btn-sm btn-success', 'style' => '    border: #84d0fb;
//    color: #337ab7;
//    margin: 2px;']) . ' ' .
//                                            Html::a('Loading Fees', ['/loading-fees', 'id' => $model->id], ['class' => 'btn btn-sm btn-warning', 'style' => '    border: #84d0fb;
//    color: #337ab7;
//    margin: 2px;']).' '.
//                                            Html::a('Shipping Fees', ['/shipping-fees', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary', 'style' => '    border: #84d0fb;
//    color: #337ab7;
//    margin: 2px;']) . ' '.
//                                             Html::a('Other Fees', ['/other-fees', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary', 'style' => '    border: #84d0fb;
//    color: #337ab7;
//    margin: 2px;
//    background-color: #84d0fb !important;']);
//                                    return $btn;
//                                },
//                                'format' => 'raw',
//                            ],
                            [
                                'class' => 'webvimark\components\StatusColumn',
                                'attribute' => 'status',
                                'optionsArray' => [
                                    [User::STATUS_ACTIVE, t('Active'), 'success'],
                                    [User::STATUS_INACTIVE, t('Inactive'), 'warning'],
                                    [User::STATUS_BANNED, t('Banned'), 'danger'],
                                ],
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'contentOptions' => ['style' => 'width:70px; text-align:center;'],
                            ],
                        ],
                    ]);
                    ?>


        </div>
    </div>
</div>
