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
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
        <link rel="shortcut icon" href="<?= imageURL('favicon.jpg') ?>" type="image/x-icon">
        <meta name="description" content="موقع الرسام أنور خورشيد">
        <title><?= Html::encode($this->title) ?></title>

        <?php $this->head() ?>
        <?php
        DashboardAsset::register($this);
        ?>
        <?= Html::csrfMetaTags() ?>

    </head>

    <body>
    <?php $this->beginBody() ?>
    <section class="menu menu1 cid-si3g2wmwIK" once="menu" id="menu1-6">
        <nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
            <div class="container-fluid">
                <div class="navbar-brand">
                    <span class="navbar-caption-wrap">
                        <a class="navbar-caption text-black text-primary display-7"
                                                         href="<?= Yii::$app->urlManager->createUrl('/') ?>">
                            <?php //echo Yii::$app->params['title'] ?>
                            <img style="height: 50px; width: 100px;" class="img-sm" src="<?= imageURL('logo.png') ?>">
                        </a>
                    </span>
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
                                <?= t('Home')?>
                            </a>
                        </li>
                        <li class="nav-item"><a class="nav-link link text-black text-primary display-4"
                                                href="<?= Yii::$app->urlManager->createUrl("/site/about") ?>">
                                <?= t('About')?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link text-black text-primary display-4"
                               href="<?= Yii::$app->urlManager->createUrl("/paintings/index") ?>">
                                <?= t('Art Works')?>
                                <br>
                            </a>
                        </li>
                        <li class="nav-item"><a class="nav-link link text-black text-primary display-4"
                                                href="<?= Yii::$app->urlManager->createUrl("/tools/index") ?>">
                                <?= t('Art Tools')?>
                            </a>
                        </li>
                        <li class="nav-item"><a class="nav-link link text-black text-primary display-4"
                                                href="<?= Yii::$app->urlManager->createUrl("/courses/index") ?>">
                                <?= t('Art Training')?>
                            </a>
                        </li>
                        <li class="nav-item"><a class="nav-link link text-black text-primary display-4"
                                                href="<?= Yii::$app->urlManager->createUrl("/packages/index") ?>">
                                <?= t('Art Tables')?>
                            </a>
                        </li>
                        <li class="nav-item"><a class="nav-link link text-black text-primary display-4"
                                                href="<?= Yii::$app->urlManager->createUrl("/halls/index") ?>">
                                <?= t('Art Classes')?>
                            </a>
                        </li>
                        <li class="nav-item"><a class="nav-link link text-black text-primary display-4"
                                                href="<?= Yii::$app->urlManager->createUrl("/contact-us") ?>">
                                <?= t('Contact Us')?>
                            </a>
                        </li>

                        <?php if (!Yii::$app->user->isGuest) { ?>
                            <li class="nav-item"><a class="nav-link link text-black text-primary display-4"
                                                    href="<?= Yii::$app->urlManager->createUrl("/user/profile/update") ?>">
                                    <?= t('Profile')?>
                                </a>
                            </li>
                            <li class="nav-item"><a class="nav-link link text-black text-primary display-4"
                                                    href="<?= Yii::$app->urlManager->createUrl("/request") ?>">
                                    <?= t('My Requests')?>
                                </a>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item"><a class="nav-link link text-black text-primary display-4"
                                                    href="<?= Yii::$app->urlManager->createUrl("/user/auth/login") ?>">
                                    <?= t('Login')?>
                                </a>
                            </li>
                        <?php } ?>

                        <?php if (Yii::$app->language != 'ar') { ?>
                            <li class="nav-item">
                                <a class="nav-link link text-black text-primary display-4"
                                                    href="<?= Yii::$app->urlManager->createUrl("/site/lang?l=ar") ?>">
                                    <?= 'العربية'?>
                                </a>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item"><a class="nav-link link text-black text-primary display-4"
                                                    href="<?= Yii::$app->urlManager->createUrl("/site/lang?l=en") ?>">
                                    <?= 'English'?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </section>

    <?= $content ?>

    <?php
    $app = \common\models\AppInfo::find()->one();
    ?>

    <section class="footer3 cid-si3niDrJAs" once="footers" id="footer3-c">
        <div class="container-fluid">
            <div class="media-container-row align-center mbr-white">
                <div class="row row-links">
                    <ul class="foot-menu">
                        <li class="foot-menu-item mbr-fonts-style display-7">
                            <a class="text-white text-primary" href="<?= Yii::$app->urlManager->createUrl("/site/about") ?>" target="_blank">
                                <?= t('About us') ?>
                            </a>
                        </li>
                        <li class="foot-menu-item mbr-fonts-style display-7">
                            <a class="text-white text-primary" href="<?= Yii::$app->urlManager->createUrl("/site/terms") ?>" target="_blank">
                                <?= t('Terms & Conditions') ?>
                            </a>
                        </li>
                        <li class="foot-menu-item mbr-fonts-style display-7">
                            <a class="text-white" href="<?= Yii::$app->urlManager->createUrl("/contact-us") ?>" target="_blank">
                                <?= t('Contact Us') ?>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="social-list align-right pb-2">
                        <div class="soc-item">
                            <a href="<?= $app->facebook_url?>" target="_blank">
                                <span class="mbr-iconfont mbr-iconfont-social socicon-facebook socicon"></span>
                            </a>
                        </div>
                        <div class="soc-item">
                            <a href="<?= $app->youtube_url?>" target="_blank">
                                <span class="mbr-iconfont mbr-iconfont-social socicon-youtube socicon"></span>
                            </a>
                        </div>
                        <div class="soc-item">
                            <a href="<?= $app->instagram_url?>" target="_blank">
                                <span class="mbr-iconfont mbr-iconfont-social socicon-instagram socicon"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row row-copirayt">
                    <p class="mbr-text mb-0 mbr-fonts-style mbr-white align-center display-4">
                        <?= t('ARTZONA') . ' ' .date('Y') .', '.t('all rights reserved') ?>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section
            style="background-color: #242424; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Helvetica Neue', Arial, sans-serif; color:#aaa; font-size:12px; padding: 0; align-items: center; display: flex;">
        <a href="https://mobirise.site/w" style="flex: 1 1; height: 3rem; padding-left: 1rem;"></a>
        <p style="flex: 0 0 auto; margin:0; padding-right:1rem;"><a href="https://mobirise.site/u"
                                                                    style="color:#aaa;"></a></p>
    </section>

    <div class="modal fade" id="myModal" data-loading="<?= t( 'Loading...') ?>"
         data-close="<?= \Yii::t('all', 'Close') ?>" tabindex="-1" aria-labelledby="myModalLabel" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog" id="modalContent" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= t( 'Loading...') ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style=""><?= t( 'Close') ?></button>
                </div>
            </div>
        </div>
    </div>


    <input name="animation" type="hidden">

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>
<script>
    var url = <?= json_encode(Url::to(['/'], true)) ?>;
    var lang = <?= json_encode(Yii::$app->language) ?>;
</script>



