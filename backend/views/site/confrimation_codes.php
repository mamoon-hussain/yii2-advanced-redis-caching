<?php

use common\enums\ActiveInactiveStatus;
use common\models\Category;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use common\enums\UserConfirmationType;
use common\enums\YesNoEnum;
use webvimark\modules\UserManagement\models\ZUser;

/* @var $this yii\web\View */
/* @var $searchModel common\models\generated\search\RegionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Confrimation Codes';
$this->params['breadcrumbs'][] = $this->title;
setViewParam('liActive', 'confirmation-codes');
setViewParam('liinActive', 'confirmation-codes');
?>
<div class="panel panel-default">
    <div class="panel-body">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout'=>"{items}\n{summary}\n{pager}",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'user_id',
                'value' => function($model) {
                    $user = ZUser::findOne($model->user_id);
                    return $user ? $user->fullName : \Yii::t('all', '(Not Found!)');
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'mobile',
                'value' => function($model) {
                    return $model->mobile;
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'type',
                'value' => function($model) {
                    return UserConfirmationType::LabelOfStyle($model->type);
                },
                'format' => 'raw',
                'filter' => Html::activeDropDownList($searchModel, 'type', UserConfirmationType::Labels(), ['class' => 'form-control', 'prompt' => \Yii::t('all', 'Select...')]),
            ],
            [
                'attribute' => 'confirm_code',
                'value' => function($model) {
                    return $model->confirm_code;
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'is_confirmed',
                'value' => function($model) {
                    return YesNoEnum::LabelOfStyle($model->is_confirmed);
                },
                'format' => 'raw',
                'filter' => Html::activeDropDownList($searchModel, 'is_confirmed', YesNoEnum::Labels(), ['class' => 'form-control', 'prompt' => \Yii::t('all', 'Select...')]),
            ],

        ],
    ]);
    ?>

</div>
</div>
