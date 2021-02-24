<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */

$this->title = t('About Application');
$this->params['breadcrumbs'][] = t( 'The Details');
setViewParam('liActive', 'app-info');
\yii\web\YiiAsset::register($this);
?>




<div class="panel panel-default">
    <div class="panel-body">

        <p>
            <?= Html::a(t( 'Update'), ['update'], ['class' => 'btn btn-success']) ?>
            <?= Html::button(t( 'Localization'), [
                'class' => 'activity-view-link btn btn-primary',
//                'style' => 'border: none;background: transparent;color: #2782df;',
                'data-toggle' => 'modal',
                'data-target' => '#myModal',
                'value' => Yii::$app->urlManager->createUrl("/app-info/localization")]) ?>

        </p>

        <div class="panel panel-default">
            <div class="panel-body">
                <h3><?= $model->getAttributeLabel('home_description') ?></h3>
                <?= $model->home_description ?>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-body">
                <h3><?= $model->getAttributeLabel('description') ?></h3>
                <?= $model->description ?>
            </div>
        </div>
                <h3><?= t('Contact Info') ?></h3>
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
//                        'email:email',
                        [
                            'attribute' => 'email',
                            'value' => '<a href="'.$model->email.'" target="_blank"><i class="fa fa-link"></i></a>',
                            'format' => 'raw',
                        ],
                        'phone',
                        'mobile',
//                        'site_url:url',
                        [
                            'attribute' => 'site_url',
                            'value' => '<a href="'.$model->site_url.'" target="_blank"><i class="fa fa-link"></i></a>',
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => 'facebook_url',
                            'value' => '<a href="'.$model->facebook_url.'" target="_blank"><i class="fa fa-link"></i></a>',
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => 'instagram_url',
                            'value' => '<a href="'.$model->instagram_url.'" target="_blank"><i class="fa fa-link"></i></a>',
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => 'youtube_url',
                            'value' => '<a href="'.$model->youtube_url.'" target="_blank"><i class="fa fa-link"></i></a>',
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => 'video',
                            'value' => '<video style="heigh: 200px; width: 200px" src="'.$model->videoUrl.'"></video>',
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => 'image',
                            'value' => '<video style="heigh: 200px; width: 200px" src="'.$model->imageUrl.'"></video>',
                            'format' => 'raw',
                        ],
//                        [
//                            'attribute' => 'linkedin_url',
//                            'value' => '<a href="'.$model->linkedin_url.'" target="_blank"><i class="fa fa-link"></i></a>',
//                            'format' => 'raw',
//                        ],
//                        [
//                            'attribute' => 'twitter_url',
//                            'value' => '<a href="'.$model->twitter_url.'" target="_blank"><i class="fa fa-link"></i></a>',
//                            'format' => 'raw',
//                        ],
//                        'facebook_url:url',
//                        'instagram_url:url',
//                        'linkedin_url:url',
//                        'twitter_url:url',
                    ],
                ]) ?>
            </div>
        </div>
