
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

<section class="form4 cid-si5k28crPG mbr-fullscreen" id="form4-11" style="margin-top: 100px; ">


    <div class="container">
        <div class="row">
            <div class="col-lg-3 offset-lg-1 mbr-form" data-form-type="formoid">
                <div class="mbr-form form-with-styler">
                    <div class="dragArea row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h1 class="mbr-section-title mb-4 display-2" style="direction: <?= $direction ?>">
                                <strong><?= $model->product->name ?></strong>
                            </h1>
                        </div>
                        <div class="col-lg-12 col-md col-12 form-group" style="direction: <?= $direction ?>">
                            <?= t('Price: '). $model->product->price. t('KD') ?>
                        </div>
                        <div class="col-lg-12 col-md col-12 form-group" style="direction: <?= $direction ?>">
                            <?= t('Description: '). $model->product->description ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 offset-lg-1 col-12">
                <div class="image-wrapper">
                    <img class="w-100" src="<?= $model->product->imageUrl ?>" alt="Mobirise">
                </div>
            </div>

            <div class="col-lg-12 offset-lg-1 mbr-form" data-form-type="formoid">
                <div class="mbr-form form-with-styler">
                    <div class="dragArea row">
                        <h3><?= t('Contact Info') ?></h3>
                        <?= $form->field($model, 'product_id')->hiddenInput()->label(false) ?>

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

                        <div class="col-12 col-md-auto mbr-section-btn">
                            <input name="payment_method_<?= PaymentMethod::paypal ?>" type="submit" value="<?= PaymentMethod::LabelOf(PaymentMethod::paypal) ?>" class="btn btn-success display-4">
                        </div>

                        <div class="col-12 col-md-auto mbr-section-btn">
                            <input name="payment_method_<?= PaymentMethod::cash ?>" type="submit" value="<?= PaymentMethod::LabelOf(PaymentMethod::cash) ?>" class="btn btn-warning display-4">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php ActiveForm::end(); ?>

<style>
    .form-group, h1, h3, p{
        direction: <?= $direction ?>;
        text-align: <?= $float ?>;
    }
    h3 {
        margin-top: 2% !important;
    }
</style>
