<?php

use webvimark\modules\UserManagement\components\GhostHtml;
use webvimark\modules\UserManagement\models\rbacDB\Role;
use webvimark\modules\UserManagement\models\ZUser;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\enums\PublishEnum;
use dosamigos\gallery\Gallery;
use common\enums\ActiveInactiveStatus;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\ZUser $model
 */
$this->title = $model->username;
setViewParam('liActive', 'tc');
setViewParam('liinActive', 'tc');
?>

<div class="user-view">

    <?php if (Yii::$app->session->hasFlash('flash_error')): ?>
        <div class="alert alert-danger" role="alert">
            <?= Yii::$app->session->getFlash('flash_error'); ?>
        </div>
    <?php endif; ?>
    <?php if (Yii::$app->session->hasFlash('flash_warning')): ?>
        <div class="alert alert-warning" role="warning">
            <?= Yii::$app->session->getFlash('flash_warning'); ?>
        </div>
    <?php endif; ?>
    <?php if (Yii::$app->session->hasFlash('flash_success')): ?>
        <div class="alert alert-success" role="alert">
            <?= Yii::$app->session->getFlash('flash_success'); ?>
        </div>
    <?php endif; ?>

    <div class="horizontal-scrollable-tabs">
        <div class="horizontal-tabs">
            <ul class="nav nav-tabs no-margin nav-tabs-horizontal" role="tablist">
                <li role="presentation" class="tab active" id="details-tab">
                    <a href="#details" aria-controls="details" role="tab" data-toggle="tab">
                        <?= t('Details'); ?>
                    </a>
                </li>
                <li role="presentation" class="tab" id="gallery-tab">
                    <a href="#gallery" aria-controls="gallery" role="tab" data-toggle="tab">
                        <?= t('Gallery'); ?>
                    </a>
                </li>
                <li role="presentation" class="tab" id="branches-tab">
                    <a href="#branches" aria-controls="branches" role="tab" data-toggle="tab">
                        <?= t('Branches'); ?>
                    </a>
                </li>
                <li role="presentation" class="tab" id="followers-tab">
                    <a href="#followers" aria-controls="followers" role="tab" data-toggle="tab">
                        <?= t('Followers') .'('. count($model->followers) .')'; ?>
                    </a>
                </li>


            </ul>
        </div>
    </div>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="details">
            <div class="panel panel-default">
                <div class="panel-body">
                    <p>
                        <?= Html::a(t('Edit'), ['update'], ['class' => 'btn btn-sm btn-primary']) ?>

                    <?php
                    $btns = '';
                    if ($model->is_published == PublishEnum::unpublished) {
                        $btns = Html::button('Publish', [
                            'style' => '',
                            'class' => 'activity-view-link btn btn-sm btn-warning pull-right',
                            'value' => Yii::$app->urlManager->createUrl("/user-management/profile/publish?id=$model->id&s=" . PublishEnum::published)]);
                    } else {
                        $btns = Html::button('Unpublish', [
                            'style' => '',
                            'class' => 'activity-view-link btn btn-sm btn-warning pull-right',
                            'value' => Yii::$app->urlManager->createUrl("/user-management/profile/publish?id=$model->id&s=" . PublishEnum::unpublished)]);
                    }
                    echo $btns;
                    ?>
                    </p>
                    <div class="col-md-6">
                        <?=
                        DetailView::widget([
                            'model' => $model,
                            'attributes' => [
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
                                    'value' => $model->facebook_page,
                                ],
                                [
                                    'attribute' => 'email',
                                    'value' => $model->email,
                                ],
//                                [
//                                    'label' => t('Country'),
//                                    'value' => $model->region ? $model->region->city->country->en_name : $model->region_id,
//                                ],
                                [
                                    'label' => t('City'),
                                    'value' => $model->region ? $model->region->city->en_name : $model->region_id,
                                ],
                                [
                                    'attribute' => 'region_id',
                                    'value' => $model->region ? $model->region->en_name : $model->region_id,
                                ],
                                'address',
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


                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?= t('About Training Center') ?>
                        </div>
                        <div class="panel-body">
                            <?= $model->about ? $model->about : t('(not set)') ?>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?= t('Logo & Cover Image') ?>
                        </div>
                        <div class="panel-body">
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
            </div>

        </div>
        <div role="tabpanel" class="tab-pane" id="gallery">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="<?= Yii::$app->urlManager->createUrl("/user-management/profile/remove-images?id=$model->id") ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                        <?= Html::button('Add Images', ['class' => 'btn btn-sm btn-success activity-view-link', 'style' => 'border: none; margin: 2px;', 'value' => Yii::$app->urlManager->createUrl("/user-management/profile/add-image?id=$model->id")]) ?>
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

                        <div class="panel panel-default">
                            <div class="panel-body">
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
                            </div>
                        </div>
                    </form>

                </div>
            </div>







        </div>
        <div role="tabpanel" class="tab-pane" id="branches">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?= Html::button('Add Branch', ['class' => 'btn btn-sm btn-success activity-view-link', 'style' => 'border: none; margin: 2px;', 'value' => Yii::$app->urlManager->createUrl("/branch/add?id=$model->id")]) ?>

                    <table class="table table-striped table-bordered detail-view">
                        <tbody>
                        <tr>
                            <th style="text-align: center;"><?= t('English Name') ?></th>
                            <th style="text-align: center;"><?= t('Arabic Name') ?></th>
                            <th style="text-align: center;"><?= t('Location') ?></th>
                            <th style="text-align: center;"><?= t('Address') ?></th>
                            <th style="text-align: center;"><?= t('Contact Information') ?></th>
                            <th style="text-align: center;"><?= t('Status') ?></th>
                            <th style="text-align: center;"></th>
                        </tr>
                        <tr>
                            <?php if(!$model->branches){ ?>
                                <td colspan="4" style="text-align: center;">
                                    <?= t('(no branches found!)') ?>
                                </td>
                            <?php } else { ?>
                                <?php foreach ($model->branches as $oneBranch){ ?>
                        <tr>
                            <td style="text-align: center;">
                                <?= $oneBranch->en_name ?>
                            </td>
                            <td style="text-align: center;">
                                <?= $oneBranch->ar_name ?>
                            </td>
                            <td style="text-align: center;">
                                <?= $oneBranch->location ?>
                            </td>
                            <td style="text-align: center;">
                                <?= $oneBranch->address ?>
                            </td>
                            <td style="text-align: center;">
                                <?= $oneBranch->land_number ? t('Land Number: ') . $oneBranch->land_number.'</br>' : $oneBranch->land_number ?>
                                <?= $oneBranch->mobile_number ? t('Mobile Number: ') . $oneBranch->mobile_number.'</br>' : $oneBranch->mobile_number ?>
                                <?= $oneBranch->email ? t('E-mail: ') . $oneBranch->email : $oneBranch->email ?>
                            </td>
                            <td style="text-align: center;">
                                <?= ActiveInactiveStatus::LabelOfStyle($oneBranch->status) ?>
                            </td>
                            <td style="text-align: center;">
                                <?= Html::button('<i class="fa fa-edit"></i>', ['class' => 'btn btn-sm btn-info activity-view-link', 'style' => 'border: none; margin: 2px;', 'value' => Yii::$app->urlManager->createUrl("/branch/edit?id=$oneBranch->id")]) ?>
                                <?php
                                $btns = '';
                                if ($oneBranch->status == ActiveInactiveStatus::inactive) {
                                    $btns = Html::button('<i class="fa fa-check-circle-o"></i>', [
                                        'title' => t('Activate'),
                                        'style' => 'border: none; margin: 2px;',
                                        'class' => 'activity-view-link btn btn-sm btn-success',
                                        'value' => Yii::$app->urlManager->createUrl("/branch/change-status?id=$oneBranch->id&s=" . ActiveInactiveStatus::active)]);
                                } else {
                                    $btns = Html::button('<i class="fa fa-times-circle-o"></i>', [
                                        'title' => t('De-activate'),
                                        'style' => 'border: none; margin: 2px;',
                                        'class' => 'activity-view-link btn btn-sm btn-warning',
                                        'value' => Yii::$app->urlManager->createUrl("/branch/change-status?id=$oneBranch->id&s=" . ActiveInactiveStatus::inactive)]);
                                }
                                echo $btns;
                                ?>
                                <?= Html::button('<i class="fa fa-times"></i>', ['class' => 'btn btn-sm btn-danger activity-view-link', 'style' => 'border: none; margin: 2px;', 'value' => Yii::$app->urlManager->createUrl("/branch/delete?id=$oneBranch->id")]) ?>
                            </td>
                        </tr>
                                <?php }
                            } ?>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="followers">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-striped table-bordered detail-view">
                        <tbody>
                        <tr>
                            <th style="text-align: center;"><?= t('Image') ?></th>
                            <th style="text-align: center;"><?= t('Name') ?></th>
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
                                        <img class="img-md" style="float: none;" src="<?= $oneFollower->follower->imageUrl ?>">
                                    </td>
                                    <td style="text-align: center;">
                                        <?= $oneFollower->follower->username ?>
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

<div style="display:none;">
    <div id="ninja-slider">
        <div class="slider-inner">
            <ul>
                <?php foreach ($images as $oneImage) { ?>
                    <li>
                        <a class="ns-img" href="<?= $oneImage ?>"></a>
                    </li>
                <?php } ?>
            </ul>
            <div id="fsBtn" class="fs-icon" title="Expand/Close"></div>
        </div>
    </div>
</div>

<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <!--Modal content-->
        <div class="modal-content">
            <div id='modalContent' class="">
                <p><?= t('Loading...') ?></p>
            </div>
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

<style>
    .gallery img{
        max-width: 150px;
        max-height: 150px;
        cursor:pointer;
    }
</style>


