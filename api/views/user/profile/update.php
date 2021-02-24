<?php

use webvimark\modules\UserManagement\models\User;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use webvimark\extensions\BootstrapSwitch\BootstrapSwitch;
use yii\helpers\ArrayHelper;
use common\models\Country;
use common\enums\ActiveInactiveStatus;
use kartik\select2\Select2;
use yii\web\JqueryAsset;
use common\models\Category;
use common\enums\WeekDays;
use dosamigos\datetimepicker\DateTimePicker;
use kartik\file\FileInput;
use kartik\time\TimePicker;
use common\models\City;
use common\models\Region;
use yii\web\View;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\User $model
 * @var yii\bootstrap\ActiveForm $form
 */
$this->title = t('Profile Update');
$Maintitle = t(Yii::$app->params['title']);
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

<div class="row">
    <div class="col-lg-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <?php
                $form = ActiveForm::begin([
                    'id' => 'user',
                    'validateOnBlur' => false,
                ]);
                ?>

                <div class="col-md-6" style="padding-left: 0;">
                    <?=
                    $form->field($model, 'username')
                        ->textInput(['placeholder' => t('User Name'), 'autocomplete' => 'off'])->label()
                    ?>

                    <?=
                    $form->field($model, 'en_name')
                        ->textInput(['placeholder' => t('English Name'), 'autocomplete' => 'off'])->label()
                    ?>


                    <?=
                    $form->field($model, 'ar_name')
                        ->textInput(['placeholder' => t('Arabic Name'), 'autocomplete' => 'off'])->label()
                    ?>

                    <?php if($model->isNewRecord){ ?>
                        <?=
                        $form->field($model, 'password_hash')
                            ->passwordInput(['placeholder' => t('password'), 'autocomplete' => 'off'])->label()
                        ?>
                    <?php } ?>

                    <?=
                    $form->field($model, 'phone')
                        ->textInput(['placeholder' => t('Phone'), 'autocomplete' => 'off'])->label()
                    ?>

                    <?=
                    $form->field($model, 'facebook_page')
                        ->textInput(['placeholder' => t('Facebook Page Url'), 'autocomplete' => 'off'])->label()
                    ?>

                    <?=
                    $form->field($model, 'lat')
                        ->hiddenInput(['class' => 'lat_field'])->label(false)
                    ?>

                    <?=
                    $form->field($model, 'lng')
                        ->hiddenInput(['class' => 'lng_field'])->label(false)
                    ?>
                </div>
                <div class="col-md-6" style="padding-right: 0;">
                    <div id="tc_update_map" style="height: 375px;"></div>
                </div>
                <div class="clearfix"></div>


                        <div class="col-md-4" style="padding-left: 0;">
                <?=
                            $form->field($model, 'country')->widget(Select2::classname(), [
                                'data' => ArrayHelper::map(Country::find()->where(['is_active' => ActiveInactiveStatus::active])->all(), 'id', 'en_name'),
                                'options' => ['placeholder' => t('Select one...'), 'class' => 'country_select'],
                            ]);
                ?>
                        </div>
                <div class="col-md-4" style="padding-left: 0;">
                    <?php
                    $cities = ArrayHelper::map(City::find()
                        ->where(['is_active' => ActiveInactiveStatus::active])
                        ->all(), 'id', 'en_name');
                    if($model->country){
                        $cities = ArrayHelper::map(City::find()
                            ->where(['is_active' => ActiveInactiveStatus::active])
                            ->andWhere(['country_id' => $model->country])
                            ->all(), 'id', 'en_name');
                    }
                    echo $form->field($model, 'city')->widget(Select2::classname(), [
                        'data' => $cities,
                        'options' => ['placeholder' => t('Select one...'), 'class' => 'city_select'],
                    ]);
                    ?>
                </div>
                <div class="col-md-4" style="padding-right: 0;">
                    <?php
                    $regions = [];
                    if($model->city){
                        $regions = ArrayHelper::map(Region::find()
                            ->where(['is_active' => ActiveInactiveStatus::active])
                            ->andWhere(['city_id' => $model->city])
                            ->all(), 'id', 'en_name');
                    }
                    echo $form->field($model, 'region_id')->widget(Select2::classname(), [
                        'data' => $regions,
                        'options' => ['placeholder' => t('Select one...'), 'class' => 'region_select'],
                    ]);
                    ?>
                </div>

                <?=
                $form->field($model, 'address')
                    ->textarea(['placeholder' => t('Address (En)'), 'autocomplete' => 'off'])->label()
                ?>

                <?=
                $form->field($model, 'ar_address')
                    ->textarea(['placeholder' => t('Address (Ar)'), 'autocomplete' => 'off'])->label()
                ?>

                <div class="col-md-6" style="padding-left: 0;">
                    <?=
                    $form->field($model, 'email')
                        ->textInput(['placeholder' => t('Email'), 'autocomplete' => 'off'])->label()
                    ?>
                </div>
                <div class="col-md-6" style="padding-left: 0;">
                    <?=
                    $form->field($model, 'main_category')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(Category::find()->where(['status' => ActiveInactiveStatus::active])->all(), 'id', 'en_name'),
                        'options' => ['placeholder' => t('Select one...')],
                    ]);
                    ?>
                </div>

                <?=
                $form->field($model, 'open_days')->widget(Select2::classname(), [
                    'data' => WeekDays::Labels(),
                    'options' => ['placeholder' => t('Select one...'), 'multiple' => true],
                ]);
                ?>

                <div class="col-md-12" style="padding: 0;">
                    <label><?= t('Open Hours') ?></label>
                </div>
                <div class="col-md-6" style="padding-left: 0;">
                    <div class="form-group field-zadmin-open_hours_from">
                        <label class="control-label" for="zadmin-open_hours_from"><?= $model->getAttributeLabel('open_hours_from') ?></label>
                        <?= TimePicker::widget([
                            'name' => 'ZAdmin[open_hours_from]',
                            'value' => $model->open_hours_from,
                            'pluginOptions' => [
                                'showSeconds' => false
                            ]
                        ]);
                        ?>
                        <p class="help-block help-block-error"></p>
                    </div>
                </div>
                <div class="col-md-6" style="padding-right: 0;">
                    <div class="form-group field-zadmin-open_hours_from">
                        <label class="control-label" for="zadmin-open_hours_to"><?= $model->getAttributeLabel('open_hours_to') ?></label>
                        <?= TimePicker::widget([
                            'name' => 'ZAdmin[open_hours_to]',
                            'value' => $model->open_hours_to,
                            'pluginOptions' => [
                                'showSeconds' => false
                            ]
                        ]);
                        ?>
                        <p class="help-block help-block-error"></p>
                    </div>

                </div>

                <?=
                $form->field($model, 'en_about')
                    ->textarea(['placeholder' => t('Type here...'), 'autocomplete' => 'off'])->label()
                ?>
                <?=
                $form->field($model, 'ar_about')
                    ->textarea(['placeholder' => t('Type here...'), 'autocomplete' => 'off'])->label()
                ?>

                <div class="col-md-6" style="padding-left: 0;">
                    <?php if ($model->logo) { ?>
                        <?=
                        $form->field($model, 'logoFile')->widget(FileInput::classname(), ['options' => ['accept' => 'image/*'],
                            'pluginOptions' => [
                                'initialPreview' => [
                                    Html::img($model->logoUrl, ['class' => 'file-preview-image', 'style' => 'max-height: 200px']),
                                ],
                                'initialCaption' => $model->logo,
                                'overwriteInitial' => true
                            ]
                        ]);
                        ?>
                    <?php } else { ?>
                        <?= $form->field($model, 'logoFile')->widget(FileInput::classname(), ['options' => ['accept' => 'image/*'],]); ?>
                    <?php } ?>
                </div>
                <div class="col-md-6" style="padding-right: 0;">
                    <?php if ($model->cover_image) { ?>
                        <?=
                        $form->field($model, 'coverImageFile')->widget(FileInput::classname(), ['options' => ['accept' => 'image/*'],
                            'pluginOptions' => [
                                'initialPreview' => [
                                    Html::img($model->coverImageUrl, ['class' => 'file-preview-image', 'style' => 'max-height: 200px']),
                                ],
                                'initialCaption' => $model->cover_image,
                                'overwriteInitial' => true
                            ]
                        ]);
                        ?>
                    <?php } else { ?>
                        <?= $form->field($model, 'coverImageFile')->widget(FileInput::classname(), ['options' => ['accept' => 'image/*'],]); ?>
                    <?php } ?>
                </div>
                <div class="clearfix"></div>


                <?=
                Html::submitButton(
                    '<span class="glyphicon glyphicon-ok"></span> ' . t('Save Changes'), //UserManagementModule::t('back', 'Save'),
                    ['class' => 'btn btn-success btn-submit']
                )
                ?>
                <?php ActiveForm::end(); ?>
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
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?= Yii::$app->params['google_api_key'] ?>" type="text/javascript"></script>
<?php $this->registerJsFile('@web/js/tc_update_map.js', ['depends' => [yii\web\JqueryAsset::className()]]); ?>
<?php $this->registerJsFile('@web/js/location.js', ['depends' => [yii\web\JqueryAsset::className()]]); ?>

<style>
    .col-md-6 {
        float: left;
    }
</style>
