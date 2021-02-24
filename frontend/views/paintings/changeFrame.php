



<section class="projects-section bg-light" id="projects">
    <div class="container">
        <!-- Featured Project Row-->
        <div class="row align-items-center no-gutters mb-4 mb-lg-5">
            <div class="col col-lg-12">
                <div class="col-xl-8 col-lg-12"><img class="img-fluid mb-3 mb-lg-0" src="<?= $model->ImageUrl ?>" style="max-width: 100%" alt=""></div>

                <div   id="similar-product" class="carousel slide col-xl-8 col-lg-12" data-ride="carousel">

                    <div class="carousel-inner">
                        <?php
                        $activeLi = 'active';
                        $activeLiAdded = false;
                        foreach ($frames as $item){

                            if (!$activeLiAdded){
                                $activeLi='active';
                                $activeLiAdded = true;
                            } else{
                                $activeLi='';
                            }
                            ?>
                            <div class="item <?= $activeLi ?>">
                                <?php foreach ($item as $singleItem){ ?>
                                    <a href="">
                                        <img style="max-width: 84px; max-height: 84px;" src="<?= $singleItem->imageUrl ?>" alt="" />
                                    </a>

                                <?php } ?>
                            </div>
                        <?php } ?>

                    </div>

                    <!-- Controls -->
                    <a class="left item-control" href="#similar-product" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right item-control" href="#similar-product" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
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
$this->registerCssFile('@web/js/eshopper/jquery.js');
$this->registerCssFile('@web/js/eshopper/price-range.js');
$this->registerCssFile('@web/js/eshopper/jquery.scrollUp.min.js');
$this->registerCssFile('@web/js/eshopper/bootstrap.min.js');
$this->registerCssFile('@web/js/eshopper/jquery.prettyPhoto.js');
$this->registerCssFile('@web/js/eshopper/main.js');

?>
