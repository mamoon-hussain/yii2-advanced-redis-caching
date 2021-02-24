<section class="banner-area pt--70 pt-md--55 pb--40 pb-md--30">
    <div class="container-fluid p-0">
        <div class="row mb--40 mb-md--30">
            <div class="col-12 text-center">
                <h2 class="heading-secondary"><?= t('About Us') ?></h2>
                <hr class="separator center mt--25 mt-md--15">
            </div>
        </div>


        <div class="container container-vip-sy">
            <div class="site-error">

                <?= (Yii::$app->language == 'ar') ? $model->ar_content : $model->content ?>

            </div>
        </div>
    </div>

</section>

