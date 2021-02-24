
<?php
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use common\enums\PaymentMethod;

$this->title = t('Checkout');
$direction = 'ltr';
$float = 'left';
if(Yii::$app->language == 'ar'){
    $direction = 'rtl';
    $float = 'right';
}
?>

<?php
$form = ActiveForm::begin();
?>

<section class="header13 cid-sihzndO6eA mbr-fullscreen" id="header13-1c" style="background-image: url('<?= imageURL('mbr-1920x1282.jpg') ?>');">
    <div class="mbr-overlay" style="opacity: 0.2; background-color: rgb(53, 53, 53);"></div>
    <div class="align-center container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <h1 class="mbr-section-title mbr-fonts-style mb-3 display-1">
                    <div style="direction: rtl;"><?= $this->title ?></div>
                </h1>
                <p class="mbr-text mbr-fonts-style mb-3 display-7"></p>
                <p></p>
            </div>
        </div>
    </div>
</section>

<section class="pricing2 cid-sihA3oOBNP" id="pricing2-1e">
    <div class="container">
        <div class="row justify-content-center">

                <div class="align-center col-lg-5" style="    margin-top: 2%;">
                    <div class="plan mb-4" style="border-radius: 20px; background-color: blueviolet;background-image: url(<?= $course->imageUrl ?>);background-repeat: no-repeat;
                            background-size: 100% 100%;">
                        <div class="plan-header pt-3">
                            <h6 class="plan-title mbr-fonts-style mb-3 display-5">
                                <strong><?= $course->name ?></strong>
                            </h6>
                            <div class="plan-price">
                                <p class="price mbr-fonts-style m-0 display-1" style="direction: <?= $direction ?>">
                                    <strong><?= $course->price.t('KD') ?> </strong>
                                </p>
                                <p class="price-term mbr-fonts-style mb-3 display-7" style="font-size: 0.9rem;direction: <?= $direction ?>">
                                    <strong>
                                        <?= t('From: ').date('M-d', strtotime($course->start_date))
                                        .' - '.t('Until: ')
                                        .date('M-d', strtotime($course->end_date)) ?>
                                    </strong>
                                </p>
                                <p class="price-term mbr-fonts-style mb-3 display-7" style="font-size: 0.9rem;direction: <?= $direction ?>">
                                    <strong>
                                        <?= ($course->seats_number - $course->requestsNumber). ' '. t('Seats') ?>
                                    </strong>
                                </p>
                            </div>
                        </div>
                        <div class="plan-body">
                            <div class="plan-list mb-3">
                                <ul class="list-group mbr-fonts-style list-group-flush display-7 <?php
                                if(Yii::$app->language != 'ar'){
                                    echo 'text-left';
                                } else {
                                    echo 'text-right';
                                }
                                ?>">
                                    <?php foreach ($course->placeContents as $oneContent) { ?>
                                        <li class="list-group-item bg-transparent" style="padding: 5px 15px;">
                                            <?= $oneContent->content ?>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>

            <div class="col-lg-6 offset-lg-1 mbr-form" data-form-type="formoid" style="margin-top: 5%;">
                <div class="mbr-form form-with-styler">
                    <div class="dragArea row">
                        <h3 style="direction: <?= $direction ?>; text-align: <?= $float ?>"><?= t('Contact Info') ?></h3>
                        <?= $form->field($model, 'place_id')->hiddenInput()->label(false) ?>

                        <div class="col-md-6">
                            <?= $form->field($model, 'fname')->textInput(['maxlength' => 255]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'lname')->textInput(['maxlength' => 255]) ?>
                        </div>

                        <div class="col-md-6">
                            <?= $form->field($model, 'phone')->textInput(['maxlength' => 255]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>
                        </div>

                        <div class="col-md-6">
                            <input style="width: 100%; margin: 1% 0;" name="payment_method_<?= PaymentMethod::paypal ?>" type="submit" value="<?= PaymentMethod::LabelOf(PaymentMethod::paypal) ?>" class="btn btn-success display-4">
                        </div>

                        <div class="col-md-6">
                            <input style="width: 100%;margin: 1% 0;" name="payment_method_<?= PaymentMethod::cash ?>" type="submit" value="<?= PaymentMethod::LabelOf(PaymentMethod::cash) ?>" class="btn btn-warning display-4">
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<?php ActiveForm::end(); ?>


<style>
    .form-group{
        direction: <?= $direction ?>;
        text-align: <?= $float ?>;
    }

</style>
