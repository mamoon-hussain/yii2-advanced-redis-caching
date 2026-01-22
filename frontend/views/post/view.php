<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
setViewParam('liActive', 'home');
$this->title = t('Posts');
?>

<section class="header13 cid-sihzndO6eA mbr-fullscreen" id="header13-1c" style="background-image: url('<?= imageURL('mbr-1920x1282.jpg') ?>');">
    <div class="mbr-overlay" style="opacity: 0.2; background-color: rgb(53, 53, 53);"></div>
    <div class="align-center container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <h1 class="mbr-section-title mbr-fonts-style mb-3 display-1">
                    <div style="direction: rtl;"><?= t('Posts') ?></div>
                </h1>
                <p class="mbr-text mbr-fonts-style mb-3 display-7"></p>
                <div style="direction: rtl;">
                    <span style="font-size: 1.2rem;">
                        <?= t('In Artzona, we strive to develop and transfer the participants from the painter stage to what is greater skill, art and knowledge.') ?>
                    </span>
                </div>
                <p></p>
            </div>
        </div>
    </div>
</section>


<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- Post Details -->
    <div class="row">
        <div class="col-md-8">
            <?php if ($model->imageUrl): ?>
                <img src="<?= $model->imageUrl ?>" alt="<?= Html::encode($model->title) ?>" class="img-fluid mb-3">
            <?php endif; ?>
            <p><strong>Views: <?= $model->views ?></strong></p>  <!-- Views counter -->
            <p><?= Html::encode($model->content) ?></p>
            <p><small>Posted by <?= $model->author ? Html::encode($model->author->username) : 'Unknown' ?> on <?= Yii::$app->formatter->asDatetime($model->created_at) ?></small></p>
        </div>
    </div>

    <!-- Comments Section -->
    <h3>Comments</h3>
    <?php if (!empty($comments)): ?>
        <div class="comments-list">
            <?php foreach ($comments as $comment): ?>
                <div class="comment border p-2 mb-2">
                    <strong><?= Html::encode($comment->user ? $comment->user->username : 'Anonymous') ?>:</strong>
                    <p><?= Html::encode($comment->content) ?></p>
                    <small>Posted on <?= Yii::$app->formatter->asDatetime($comment->created_at) ?></small>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No comments yet.</p>
    <?php endif; ?>

    <!-- Add Comment Form -->
    <h4>Add a Comment</h4>
    <?php if (!Yii::$app->user->isGuest): ?>
        <?= $this->render('_comment_form', ['model' => new \app\models\Comment(), 'postId' => $model->id]) ?>
    <?php else: ?>
        <p>Please <a href="<?= Yii::$app->urlManager->createUrl(['site/login']) ?>">login</a> to comment.</p>
    <?php endif; ?>

</div>



