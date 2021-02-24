<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Place;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\PlaceContentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Place Contents';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="place-contents-index">

    <p>
        <?= Html::a('Create Place Contents', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' =>'place_id',
                'value'  => 'place.name',
                'filter' => Html::activeDropDownList($searchModel,'place_id',ArrayHelper::map(
                    Place::find()
                        ->all(),'id','name'),
                    ['class' =>'form-control','prompt' =>t('Select')]),
                //'format' => 'raw',
            ],

            'content:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
