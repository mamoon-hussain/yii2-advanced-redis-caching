
<header >
    <div class="container d-flex h-100 align-items-center">
        <div class="mx-auto text-center">
            <h1 class="mx-auto my-0 text-uppercase">PAINTER</h1>
            <h2 class="text-white-50 mx-auto mt-2 mb-5">this is a website fore some painter</h2>
            <h2 class="title text-center">Paintings</h2>
        </div>
    </div>
</header>


<section class="projects-section bg-light" id="projects">
    <div class="container">
        <!-- Featured Project Row-->
        <div class="row align-items-center no-gutters mb-4 mb-lg-5">
            <div class="col col-lg-6">
                <div class="col-xl-8 col-lg-6">
                    <a href="<?= Yii::$app->urlManager->createUrl("/product/add-frame?id=".$model->id) ?>"> "<img class="img-fluid mb-3 mb-lg-0" src="<?= $model->ImageUrl ?>" style="max-width: 100%" alt="">
                    </a>
                </div>

            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="featured-text text-center text-lg-left">
                    <h3><?= $model->name ?></h3>
                    <div>
                        <span>US <?= $model->price ?>$</span>
                        <button type="button" class="btn btn-default cart" style="background-color: #ffa500; margin-left: 10%">
                            <i class="fa fa-shopping-cart"></i>
                            Add to cart
                        </button>
                    </div>
                    <p class="text-black-50 mb-0"><?= $model->description ?></p>
                    <a class="btn btn-outline-success cart" style="background-color: #00FF00" href="<?= Yii::$app->urlManager->createUrl("/packages/check?id=".$model->id) ?>" role="button">
                        <?= t('check out') ?>
                        <i class="fa fa-shopping-cart"></i>

                        </i></a>
                </div>
            </div>
        </div>


    </div>

</section>


<?php
$this->registerCssFile('@web/css/eshopper/animate.css');
$this->registerCssFile('@web/css/eshopper/bootstrap.min.css');
$this->registerCssFile('@web/css/eshopper/font-awesome.min.css');
$this->registerCssFile('@web/css/eshopper/main.css');
$this->registerCssFile('@web/css/eshopper/prettyPhoto.css');
$this->registerCssFile('@web/css/eshopper/price-range.css');
$this->registerCssFile('@web/css/eshopper/responsive.css');

?>
<?php
$this->registerJsFile('@web/js/eshopper/jquery.js');
$this->registerJsFile('@web/js/eshopper/price-range.js');
$this->registerJsFile('@web/js/eshopper/jquery.scrollUp.min.js');
$this->registerJsFile('@web/js/eshopper/bootstrap.min.js');
$this->registerJsFile('@web/js/eshopper/jquery.prettyPhoto.js');
$this->registerJsFile('@web/js/eshopper/main.js');

?>
