
<?php
use yii\widgets\Pjax;
use yii\widgets\ListView;
use common\enums\CourseType;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
setViewParam('liActive', 'home');
$this->title = t('Contact Us');
?>


<section class="map2 cid-si5jZnmuJW" id="map2-10">
    <div>
        <div class="google-map">
            <iframe frameborder="0" style="border:0"
                  src="https://maps.google.com/maps?q=29.347077053872667,%2048.08549359761999&t=&z=17&ie=UTF8&iwloc=&output=embed"
                  allowfullscreen="">
            </iframe>
        </div>
    </div>
</section>


<section class="form4 cid-si5k28crPG mbr-fullscreen" id="form4-11">

    <div class="container">
        <div class="row content-wrapper justify-content-center">
            <?php if (Yii::$app->session->hasFlash('flash_error')): ?>
                <div class="alert alert-danger" role="alert">
                      <?= Yii::$app->session->getFlash('flash_error'); ?>
                </div>
            <?php endif; ?>
            <?php if (Yii::$app->session->hasFlash('flash_warning')): ?>
                <div class="alert alert-warning" role="alert">
                    <?= Yii::$app->session->getFlash('flash_warning'); ?>
                </div>
            <?php endif; ?>
            <?php if (Yii::$app->session->hasFlash('flash_success')): ?>
                <div class="alert alert-success" role="alert">
                    <?= Yii::$app->session->getFlash('flash_success'); ?>
                </div>
            <?php endif; ?>
            <div class="col-lg-3 offset-lg-1 mbr-form" data-form-type="formoid">


                <?php $form = ActiveForm::begin([
                    'options' => [
                        'class' => 'mbr-form form-with-styler',
                    ]
                ]); ?>

                <div class="dragArea row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h1 class="mbr-section-title mb-4 display-2">
                            <strong><?= t('Contact Us') ?></strong>
                        </h1>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <p class="mbr-text mbr-fonts-style mb-4 display-7">
                            <?= $app_info->phone ?>
                            <a href="tel:<?= $app_info->phone ?>">
                                <i class="fa fa-phone"></i>
                            </a>
                        </p>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <p class="mbr-text mbr-fonts-style mb-4 display-7">
                            <?= $app_info->email ?>
                            <i class="fa fa-envelope"></i>
                        </p>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <p class="mbr-text mbr-fonts-style mb-4 display-7">
                            <?= t('Fill this form and we\'ll get back to you soon.') ?>
                        </p>
                    </div>
                    <div class="col-lg-12 col-md col-12 form-group">
                        <?= $form->field($model, 'name')->textInput(['placeholder' => $model->getAttributeLabel('name')])->label(false) ?>

                    </div>
                    <div class="col-lg-12 col-md col-12 form-group">
                        <?= $form->field($model, 'phone')->textInput(['placeholder' => $model->getAttributeLabel('phone')])->label(false) ?>
                    </div>
                    <div class="col-12 col-md-auto mbr-section-btn">
                        <button type="submit" class="btn btn-secondary display-4"><?= t('Submit'); ?></button>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="col-lg-7 offset-lg-1 col-12">
                <div class="image-wrapper">
                    <img class="w-100" src="<?= imageURL('sq3.jpg')?>" alt="Mobirise">
                </div>
            </div>
        </div>
    </div>
</section>
