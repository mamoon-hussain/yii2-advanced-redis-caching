<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\web\YiiAsset;

/** @var yii\web\View $this */
/** @var common\models\Post $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
setViewParam('liActive', 'post');

?>
<div class="post-view">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h1 class="card-title mb-0"><?php echo Html::encode($this->title); ?></h1>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3">
                <div class="btn-group" role="group">
                    <?= Html::a('<i class="fas fa-edit"></i> Update', ['update', 'id' => $model->id], ['class' => 'btn btn-outline-primary']) ?>
                    <?= Html::a('<i class="fas fa-trash"></i> Delete', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-outline-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </div>
            </div>

            <!-- Metadata fields grouped in rows for better layout -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="border rounded p-2 bg-light">
                        <strong><i class="fas fa-user"></i> <?= $model->getAttributeLabel('author_id') ?> </strong><br>
                        <?php echo Html::encode($model->author->username); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="border rounded p-2 bg-light">
                        <strong><i class="fas fa-tags"></i> <?= $model->getAttributeLabel('category_id') ?> </strong><br>
                        <?php echo Html::encode($model->category->name); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="border rounded p-2 bg-light">
                        <strong><i class="fas fa-eye"></i> <?= $model->getAttributeLabel('views') ?> </strong><br>
                        <?php echo Html::encode($model->views); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="border rounded p-2 bg-light">
                        <strong><i class="fas fa-info-circle"></i> <?= $model->getAttributeLabel('status') ?> </strong><br>
                        <?php echo Html::encode($model->status); ?>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="border rounded p-2 bg-light">
                        <strong><i class="fas fa-calendar-plus"></i> <?= $model->getAttributeLabel('created_at') ?> </strong><br>
                        <?php echo Html::encode(Yii::$app->formatter->asDatetime($model->created_at)); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="border rounded p-2 bg-light">
                        <strong><i class="fas fa-calendar-check"></i> <?= $model->getAttributeLabel('updated_at') ?> </strong><br>
                        <?php echo Html::encode(Yii::$app->formatter->asDatetime($model->updated_at)); ?>
                    </div>
                </div>
            </div>

            <!-- Main content fields in DetailView -->
            <?= DetailView::widget([
                'model' => $model,
                'options' => ['class' => 'table table-bordered table-hover'],
                'attributes' => [

                    [
                        'attribute' => 'title',
//                        'label' => '<i class="fas fa-heading"></i> Title',
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'content',
//                        'label' => '<i class="fas fa-file-alt"></i> Content',
                        'format' => 'html', // Assuming content may contain HTML
                    ],
                    [
                        'attribute' => 'image',
//                        'label' => '<i class="fas fa-image"></i> Image',
                        'value' => function ($model) {
                            return $model->image ? Html::img($model->image, ['class' => 'img-fluid rounded', 'alt' => 'Post Image']) : 'No image';
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'video',
//                        'label' => '<i class="fas fa-video"></i> Video',
                        'value' => function ($model) {
                            return $model->video ? Html::tag('video', '', ['src' => $model->video, 'controls' => true, 'class' => 'w-100']) : 'No video';
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'url',
                        'label' => '<i class="fas fa-link"></i> URL',
                        'format' => 'url',
                    ],
                ],
            ]) ?>
        </div>
    </div>
</div>

<style>
    .post-view .card {
        margin: 20px 0;
    }
    .post-view .btn-group .btn {
        margin-right: 5px;
    }
    .post-view .row .col-md-3, .post-view .row .col-md-6 {
        margin-bottom: 10px;
    }
    .post-view .table th {
        background-color: #f8f9fa;
        font-weight: bold;
    }
</style>