<?php
use frontend\assets\DashboardAsset;
use frontend\assets\CookiesAsset;
use yii\helpers\Html;
use yii\helpers\Url;

$liActive = viewParam('liActive', '');
$liinActive = viewParam('liinActive', '');
$liininActive = viewParam('liininActive', '');

DashboardAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="description" content="overview &amp; stats" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="<?= imageURL("images/web/logo.png") ?>" rel="icon" type="image/png">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?php
    DashboardAsset::register($this);
    ?>
    <link rel="preload" as="style" href="<?= Yii::$app->urlManager->createUrl('org_layout/mobirise/css/mbr-additional.css') ?>">
    <link rel="stylesheet" href="<?= Yii::$app->urlManager->createUrl('org_layout/mobirise/css/mbr-additional.css') ?>" type="text/css">
    <?= Html::csrfMetaTags() ?>
</head>
<body>
<?php $this->beginBody() ?>
<section class="menu menu1 cid-si3g2wmwIK" once="menu" id="menu1-6">
    <nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
        <div class="container-fluid">
            <div class="navbar-brand">
                    <span class="navbar-caption-wrap"><a class="navbar-caption text-black text-primary display-7"
                                                         href="index.html">ARTZONA</a></span>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                    aria-label="Toggle navigation">
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-dropdown nav-right" data-app-modern-menu="true">
                    <li class="nav-item"><a class="nav-link link text-black text-primary display-4"
                                            href="<?= Yii::$app->urlManager->createUrl("/") ?>">
                            <?= t('HOME')?></a></li>
                    <li class="nav-item">
                        <a class="nav-link link text-black text-primary display-4"
                           href="<?= Yii::$app->urlManager->createUrl("/paintings/index") ?>">
                            <?= t('ART WORKS')?>
                            <br>
                        </a>
                    </li>
                    <li class="nav-item"><a class="nav-link link text-black text-primary display-4"
                                            href="<?= Yii::$app->urlManager->createUrl("/tools/index") ?>">
                            <?= t('ART TOOLS')?><br></a></li>
                    <li class="nav-item"><a class="nav-link link text-black text-primary display-4"
                                            href="<?= Yii::$app->urlManager->createUrl("/courses/index") ?>">
                            <?= t('ART TRAINING')?></a></li>
                    <li class="nav-item"><a class="nav-link link text-black text-primary display-4"
                                            href="<?= Yii::$app->urlManager->createUrl("/packages/index") ?>"><?= t('ART TABLE')?></a>
                    </li>
                    <li class="nav-item"><a class="nav-link link text-black text-primary display-4"
                                            href="<?= Yii::$app->urlManager->createUrl("/halls/index") ?>"><?= t('ART CLASS')?></a>
                    </li>
                    <li class="nav-item"><a class="nav-link link text-black text-primary display-4"
                                            href="<?= Yii::$app->urlManager->createUrl("/contact-us") ?>"><?= t('CONTACT US')?></a>
                    </li>

                    <?php
                    if (!Yii::$app->user->isGuest) { ?>
                        <li>

                            <a class="nav-link link text-black text-primary display-4" href="<?= Yii::$app->urlManager->createUrl("/user/auth/logout") ?>">
                                <?= \Yii::$app->user->identity->username;
                                ?>
                                <?= t('Logout') ?>
                            </a>
                        </li>

                        <?php
                    }
                    else{ ?>
                        <li class="nav-item">
                            <a class="nav-link link text-black text-primary display-4" href="<?= Yii::$app->urlManager->createUrl("/user/auth/login") ?>">
                                <?= t('Login') ?>
                            </a>
                        </li>
                        <?php
                    }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link link text-black text-primary display-4"
                           href="<?= Yii::$app->urlManager->createUrl("/user/profile") ?>"><?= t('Profile') ?></a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</section>
<!-- END nav -->


<?= $content ?>


<section class="footer3 cid-si3niDrJAs" once="footers" id="footer3-c">
    <div class="container-fluid">
        <div class="media-container-row align-center mbr-white">
            <div class="row row-links">
                <ul class="foot-menu">
                    <li class="foot-menu-item mbr-fonts-style display-7">
                        <a class="text-white text-primary" href="#" target="_blank">About us</a>
                    </li>
                    <li class="foot-menu-item mbr-fonts-style display-7">
                        <a class="text-white text-primary" href="index.html#features4-8"
                           target="_blank">Services</a>
                    </li>
                    <li class="foot-menu-item mbr-fonts-style display-7">
                        <a class="text-white" href="#" target="_blank">Contact Us</a>
                    </li>
                </ul>
            </div>
            <div class="row social-row">
                <div class="social-list align-right pb-2">
                    <div class="soc-item">
                        <a href="#" target="_blank">
                            <span class="mbr-iconfont mbr-iconfont-social socicon-twitter socicon"></span>
                        </a>
                    </div>
                    <div class="soc-item">
                        <a href="#" target="_blank">
                            <span class="mbr-iconfont mbr-iconfont-social socicon-facebook socicon"></span>
                        </a>
                    </div>
                    <div class="soc-item">
                        <a href="#" target="_blank">
                            <span class="mbr-iconfont mbr-iconfont-social socicon-youtube socicon"></span>
                        </a>
                    </div>
                    <div class="soc-item">
                        <a href="#" target="_blank">
                            <span class="mbr-iconfont mbr-iconfont-social socicon-instagram socicon"></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row row-copirayt">
                <p class="mbr-text mb-0 mbr-fonts-style mbr-white align-center display-4">ARTZONA 2020, all
                    rights
                    reserved</p>
            </div>
        </div>
    </div>
</section>











<div class="modal fade" id="myModal" data-loading="<?= \Yii::t('all', 'Loading...') ?>"
     data-close="<?= \Yii::t('all', 'Close') ?>" tabindex="-1" aria-labelledby="myModalLabel" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog" id="modalContent" role="document" style="max-width: 1000px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <?= \Yii::t('all', 'Loading...') ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style=""><?= \Yii::t('all', 'Close') ?></button>
            </div>
        </div>
    </div>
</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<a href="https://api.whatsapp.com/send?phone=491631344466&text=Hallo, ich möchte bei 'Unser-Plan-B' bestellen." class="whatsapp-float" target="_blank">
    <i class="fa fa-whatsapp whatsapp-my-float"></i>
</a>


<script>
    var url = <?= json_encode(yii\helpers\BaseUrl::base()) ?>;
    var lang = <?= json_encode(Yii::$app->language) ?>;
</script>










