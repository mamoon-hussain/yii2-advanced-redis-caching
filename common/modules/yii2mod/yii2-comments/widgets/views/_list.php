<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii2mod\editable\Editable;
use common\enums\ActiveInactiveStatus;

/* @var $this \yii\web\View */
/* @var $model \yii2mod\comments\models\CommentModel */
/* @var $maxLevel null|integer comments max level */
?>
<li class="comment" id="comment-<?php echo $model->id; ?>">
    <div class="comment-content" data-comment-content-id="<?php echo $model->id; ?>">
        <div class="">
            <?php echo Html::img($model->user->imageUrl, ['alt' => $model->getAuthorName(), 'class' => 'comment-author-avatar']); ?>
        </div>
        <div class="comment-details">
            <div class="comment-action-buttons">
                <?php
                if($model->status != ActiveInactiveStatus::deleted && $can_change){
                    echo  Html::a(Yii::t('all', 'Delete'),
                        '#', [
                            'class' => 'activity-view-link',
                            'data-toggle' => 'modal',
                            'data-target' => '#myModal',
                            'style' => 'color: red;',
                            'value' => Yii::$app->urlManager->createUrl("/topic/delete-comment?id=$model->id"),
                        ]
                    );
                }
                ?>
                <?= ActiveInactiveStatus::LabelOfStyle($model->status) ?>
            </div>
            <div class="comment-author-name">
                <span><?php echo $model->getAuthorName(); ?></span>
                <?php echo Html::a($model->getPostedDate(), $model->getAnchorUrl(), ['class' => 'comment-date']); ?>
            </div>
            <div class="comment-body">
                <?php if (Yii::$app->getModule('comment')->enableInlineEdit && Yii::$app->getUser()->can('admin')): ?>
                    <?php echo Editable::widget([
                        'model' => $model,
                        'attribute' => 'content',
                        'url' => Url::to(['/comment/default/quick-edit']),
                        'options' => [
                            'id' => 'editable-comment-' . $model->id,
                        ],
                    ]); ?>
                <?php else: ?>
                    <?php echo $model->getContent(); ?>
                <?php endif; ?>
            </div>
            <?php
            if($model->status != ActiveInactiveStatus::deleted && ($model->level < $maxLevel || is_null($maxLevel)) && $can_change){
                echo Html::a(Yii::t('subject', 'Reply'), '#', [
                    'class' => 'reply-comment-btn',
                    'data' => [
                        'action' => 'reply',
                        'comment-id' => $model->id
                    ]
                ]);
            }
            ?>
        </div>
    </div>
</li>
<?php if ($model->hasChildren()) : ?>
    <ul class="children">
        <?php foreach ($model->getChildren() as $children) : ?>
            <?php
            echo $this->render('_list', [
                'model' => $children,
                'maxLevel' => $maxLevel,
                'can_change' => $can_change,
            ]);
            ?>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
