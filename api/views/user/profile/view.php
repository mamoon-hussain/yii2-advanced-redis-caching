<?php

use webvimark\modules\UserManagement\components\GhostHtml;
use webvimark\modules\UserManagement\models\rbacDB\Role;
use webvimark\modules\UserManagement\models\ZUser;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\web\View;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\enums\PublishEnum;
use dosamigos\gallery\Gallery;
use common\enums\ActiveInactiveStatus;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\ZUser $model
 */
$this->title = $model->en_name;
setViewParam('liActive', 'tc');
setViewParam('liinActive', 'tc');
?>

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>
                <?= $this->title ?>
            </div>
        </div>
    </div>
</div>
<ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
    <li class="nav-item">
        <a role="tab" class="nav-link active show" id="tab-details" data-toggle="tab" href="#details" aria-selected="true">
            <span><?= t('Details'); ?></span>
        </a>
    </li>
    <li class="nav-item">
        <a role="tab" class="nav-link show" id="tab-gallery" data-toggle="tab" href="#gallery" aria-selected="false">
            <span><?= t('Gallery'); ?></span>
        </a>
    </li>
    <li class="nav-item">
        <a role="tab" class="nav-link show" id="tab-followers" data-toggle="tab" href="#followers" aria-selected="false">
            <span><?= t('Followers') .'('. count($model->followers) .')'; ?></span>
        </a>
    </li>
</ul>
<div class="row">
    <div class="col-lg-12">

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="details">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <p>
                            <?= Html::a(t('Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                            <?= Html::a(t('Change Password'), ['change-own-password'], [
                                'class' => 'btn btn-sm btn-warning',
                                'style' => 'color: white;'
                            ]) ?>
                            <?php
                            $btns = '';
                            if ($model->is_published == PublishEnum::unpublished || $model->is_published == PublishEnum::unpublished_by_admin) {
                                $btns = Html::button('Publish', [
                                    'style' => 'color: white;',
                                    'class' => 'activity-view-link btn btn-sm btn-success pull-right',
                                    'data-toggle' => 'modal',
                                    'data-target' => '#myModal',
                                    'value' => Yii::$app->urlManager->createUrl("/user-management/profile/publish?id=$model->id&s=" . PublishEnum::published)]);
                            } else {
                                $btns = Html::button('Un-Publish', [
                                    'style' => 'color: white;',
                                    'class' => 'activity-view-link btn btn-sm btn-warning pull-right',
                                    'data-toggle' => 'modal',
                                    'data-target' => '#myModal',
                                    'value' => Yii::$app->urlManager->createUrl("/user-management/profile/publish?id=$model->id&s=" . PublishEnum::unpublished)]);
                            }
                            echo $btns;
                            ?>
                        </p>
                        <div class="col-md-6">
                            <?php
                            if (strlen($model->facebook_page) >= 60) {
                                $facebook_page = substr($model->facebook_page, 0, 60). "... ";
                            }
                            else {
                                $facebook_page = $model->facebook_page;
                            }
                            ?>
                            <?=
                            DetailView::widget([
                                'model' => $model,
                                'attributes' => [
                                    'username',
                                    'en_name',
                                    'ar_name',
                                    [
                                        'attribute' => 'is_published',
                                        'value' => PublishEnum::LabelOfStyle($model->is_published),
                                        'format' => 'raw',
                                    ],
                                    [
                                        'attribute' => 'phone',
                                        'value' => $model->phone,
                                    ],
                                    [
                                        'attribute' => 'facebook_page',
                                        'value' => $facebook_page,
                                    ],
                                    [
                                        'attribute' => 'email',
                                        'value' => $model->email,
                                    ],
                                [
                                    'label' => t('Country'),
                                    'value' => $model->region ? $model->region->city->country->en_name : $model->region_id,
                                ],
                                    [
                                        'label' => t('City'),
                                        'value' => $model->region ? $model->region->city->en_name : $model->region_id,
                                    ],
                                    [
                                        'attribute' => 'region_id',
                                        'value' => $model->region ? $model->region->en_name : $model->region_id,
                                    ],
                                    'address',
                                    'ar_address',
                                    [
                                        'attribute' => 'main_category',
                                        'value' => $model->category ? $model->category->en_name : $model->main_category,
                                        'format' => 'raw',
                                    ],
                                    [
                                        'attribute' => 'open_days',
                                        'value' => implode(', ', explode(',', $model->open_days)),
                                        'format' => 'raw',
                                    ],
                                    [
                                        'attribute' => t('open_hours'),
                                        'value' => function($model){
                                            $open_hours = json_decode($model->open_hours);
                                            if(isset($open_hours->from) && isset($open_hours->to)){
                                                return t('From: ').$open_hours->from . ', ' .t('To: ').$open_hours->to;
                                            } else {
                                                return t('(Not Set)');
                                            }
                                        },
                                        'format' => 'raw',
                                    ],
                                    [
                                        'attribute' => t('Followers Count'),
                                        'value' => count($model->followers),
                                        'format' => 'raw',
                                    ],
                                ],
                            ])
                            ?>
                        </div>
                        <div class="col-md-6">
                            <div id="tc_map" style="height: 500px;"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>

                <div class="main-card mb-3 card">
                    <div class="card-header">
                        <?= t('About Training Center (En)') ?>
                    </div>
                    <div class="card-body">
                        <?= $model->en_about ? $model->en_about : t('(not set)') ?>
                    </div>
                </div>

                <div class="main-card mb-3 card">
                    <div class="card-header">
                        <?= t('About Training Center (Ar)') ?>
                    </div>
                    <div class="card-body">
                        <?= $model->ar_about ? $model->ar_about : t('(not set)') ?>
                    </div>
                </div>

                <div class="main-card mb-3 card">
                    <div class="card-header">
                        <?= t('Logo & Cover Image') ?>
                    </div>
                    <div class="card-body">


                        <table class="table table-striped table-bordered detail-view">
                            <tbody>
                            <tr>
                                <th><?= t('Logo') ?></th>
                                <th><?= t('Cover Image') ?></th>
                            </tr>
                            <tr>
                                <th style="text-align: center;">
                                    <img src="<?= $model->logoUrl ?>" style="max-height:200px;">
                                </th>
                                <th style="text-align: center;">
                                    <img src="<?= $model->coverImageUrl ?>" style="max-height:200px;">
                                </th>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="gallery">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <form action="<?= Yii::$app->urlManager->createUrl("/user-management/profile/remove-images?id=$model->id") ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                            <?= Html::button('Add Images', [
                                'class' => 'btn btn-sm btn-success activity-view-link',
                                'style' => 'border: none; margin: 2px;',
                                'value' => Yii::$app->urlManager->createUrl("/user-management/profile/add-image?id=$model->id"),
                                'data-toggle' => 'modal',
                                'data-target' => '#myModal',
                            ]) ?>
                            <?=
                            Html::button('Remove Selected', ['class' => 'btn btn-sm btn-danger form_btn',
                                'style' => 'border: none; margin: 2px;',
                                'value' =>  Yii::$app->urlManager->createUrl("/user-management/profile/remove-images?id=$model->id"),
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete?',
                                    'method' => 'post',
                                ],])
                            ?>
                            <br/>
                            <input type="checkbox" id="select_all" /> <label for="select_all">Select all</label>

                            <div class="gallery">
                                <table class="table table-striped table-bordered detail-view">
                                    <tbody>
                                    <?php
                                    $images = [];
                                    foreach ($model->gallery as $key => $oneImage) {
                                        $images[] = $oneImage->imageUrl;
                                        if ($key % 4 == 0) {
                                            echo '<tr>';
                                        }
                                        ?>
                                        <td style="text-align: center;">
                                            <img src="<?= $oneImage->imageUrl ?>" onclick="lightbox(<?= $key ?>)" />
                                            <div style="width: 100%; display: block;">
                                                <input class="checkbox_c"  type="checkbox" name="images[]" value="<?= $oneImage->id ?>">
                                                <a href="<?= Yii::$app->urlManager->createUrl("/user-management/profile/download-image?id=$oneImage->id") ?>"><i class="fa fa-download"></i></a>
                                            </div>
                                        </td>
                                        <?php
                                        if ($key % 4 == 3) {
                                            echo '</tr>';
                                        }
                                        ?>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
            <div role="tabpanel" class="tab-pane" id="followers">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <table class="table table-striped table-bordered detail-view">
                            <tbody>
                            <tr>
                                <th style="text-align: center;"><?= t('Image') ?></th>
                                <th style="text-align: center;"><?= t('Name') ?></th>
                                <th style="text-align: center;"><?= t('Profession') ?></th>
                                <th style="text-align: center;"><?= t('Date/Time') ?></th>
                            </tr>
                            <tr>
                                <?php if(!$model->followers){ ?>
                                    <td colspan="4" style="text-align: center;">
                                        <?= t('(no followers found!)') ?>
                                    </td>
                                <?php } else { ?>
                                    <?php foreach ($model->followers as $oneFollower){ ?>
                                        <td style="text-align: center;">
                                            <img class="img-md" style="float: none;max-height: 100px;max-width: 100px;" src="<?= $oneFollower->follower->imageUrl ?>">
                                        </td>
                                        <td style="text-align: center;">
                                            <?= $oneFollower->follower->username ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?= $oneFollower->follower->profession ? $oneFollower->follower->profession->en_name : '' ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?= $oneFollower->create_date ?>
                                        </td>
                                    <?php }
                                } ?>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<div style="display:none;">
    <div id="ninja-slider" style="margin-top: 4%;">
        <div class="slider-inner">
            <ul>
                <?php foreach ($images as $oneImage) { ?>
                    <li>
                        <a class="ns-img" href="<?= $oneImage ?>"></a>
                    </li>
                <?php } ?>
            </ul>
            <div id="fsBtn" class="fs-icon" style="margin-top: 4%;" title="Expand/Close"></div>
        </div>
    </div>
</div>





<script>
    var latitude = '<?= $model->lat ? json_encode($model->lat) : 33.5138 ?>';
    var longitude = '<?= $model->lng ? json_encode($model->lng) : 36.2765 ?>';
    var mapMarkerTitle = '<?= json_encode($model->en_name) ?>';
    var markers = [];

    <?php if($model->lat && $model->lng){ ?>
    markers.push([
        <?= json_encode($model->lat) ?>,
        <?= json_encode($model->lng) ?>,
        <?= json_encode($model->en_name) ?>,
        'http://maps.google.com/mapfiles/ms/icons/blue-dot.png',
    ]);
    <?php } ?>

    <?php foreach ($model->branches as $oneBranch){ ?>
    <?php if($oneBranch->lat && $oneBranch->lng){ ?>
    markers.push([
        <?= json_encode($oneBranch->lat) ?>,
        <?= json_encode($oneBranch->lng) ?>,
        <?= json_encode(t('Branch: ').$oneBranch->en_name) ?>,
        'http://maps.google.com/mapfiles/ms/icons/red-dot.png'
    ]);
    <?php } ?>
    <?php } ?>

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?= Yii::$app->params['google_api_key'] ?>" type="text/javascript"></script>
<?php $this->registerJsFile('@web/js/tc_map.js', ['depends' => [yii\web\JqueryAsset::className()]]); ?>

<?php $this->registerCssFile('@web/css/ninja-slider.css'); ?>
<?php $this->registerJsFile('@web/js/ninja-slider.js', ['depends' => [yii\web\JqueryAsset::className()]]); ?>
<?php $this->registerJsFile('@web/js/ninja-slider-control.js', ['depends' => [yii\web\JqueryAsset::className()]]); ?>
<?php $this->registerJsFile('@web/js/location.js', ['depends' => [yii\web\JqueryAsset::className()]]); ?>

<style>
    .gallery img{
        max-width: 150px;
        max-height: 150px;
        cursor:pointer;
    }
    .col-md-6 {
        float: left;
    }
</style>


