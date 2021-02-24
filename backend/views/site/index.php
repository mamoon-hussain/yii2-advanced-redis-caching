<?php
/* @var $this yii\web\View */

use yii\web\View;
use common\enums\PaintingToolType;
use common\enums\PlaceType;

setViewParam('liActive', 1);
$this->title = Yii::t('all', Yii::$app->params['title']) . ' ' .t('Dashboard');
?>




    <div class="row">
        <div class="col-md-3">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><?= $paintingsNumber ?></h3>

                    <h4>
                        <a href="<?= Yii::$app->urlManager->createUrl("/product/index?t=".PaintingToolType::painting) ?>" class="category-link">
                            <?= t('Paintings') ?>
                        </a>
                    </h4>
                    <div class="icon" style="padding-right: 70%;">
                        <i class="fas fa-paint-brush"></i>
                    </div>
                </div>

            </div>
        </div>
        <!-- ./col -->
        <div class="col-md-3">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3><?= $toolsNumber ?></h3>
                    <h4>
                        <a href="<?= Yii::$app->urlManager->createUrl("/product/index?t=".PaintingToolType::tool) ?>" class="category-link">
                            <?= t('Tools') ?>
                        </a>
                    </h4>
                </div>
                <div class="icon" style="padding-right: 70%;">
                    <i class="fas fa-tools"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-md-3">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3 style="color: white"><?= $coursesNumber ?></h3>

                    <h4>
                        <a href="<?= Yii::$app->urlManager->createUrl("/place/index?t=".PlaceType::course) ?>" class="category-link">
                            <?= t('Courses') ?>
                        </a>
                    </h4>
                </div>
                <div class="icon" style="padding-right: 70%;">
                    <i class="fa fa-certificate"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-md-3">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3><?= $hallsnumber ?></h3>

                    <h4>
                        <a href="<?= Yii::$app->urlManager->createUrl("/place/index?t=".PlaceType::hall) ?>" class="category-link">
                            <?= t('Halls') ?>
                        </a>
                    </h4>
                </div>

                <div class="icon" style="padding-right: 70%;">
                    <i class="fa fa-home"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-md-3">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3><?= $packagesNumber ?></h3>
                    <h4>
                        <a href="<?= Yii::$app->urlManager->createUrl("/place/index?t=".PlaceType::package) ?>" class="category-link">
                            <?= t('Packages') ?>
                        </a>
                    </h4>
                </div>
                <div class="icon" style="padding-right: 70%;">
                    <i class="fab fa-artstation"></i>
                </div>
            </div>
        </div>
    </div>

<?php
$this->registerCssFile('@web/css/custom/custom.css');
?>