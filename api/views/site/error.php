<?php
/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
$this->title = t('Not found');
$this->params['breadcrumbs'][] = $this->title;
$Maintitle = t(Yii::$app->params['title']);
$storeTitle = t(Yii::$app->params['title']);
?>
<div class="breadcrumb-area bg--white-6 pt--60 pb--70 pt-lg--40 pb-lg--50 pt-md--30 pb-md--40">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="page-title"><?= $this->title ?></h1>
                <ul class="breadcrumb justify-content-center">
                    <li><a href="<?= Yii::$app->urlManager->createUrl("/site/index") ?>"> <?= $Maintitle; ?></a></li>
                    <li class="current"><span><?= $this->title ?></span></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="container container-vip-sy">
        <div class="site-error">

            <h1><?= Html::encode($this->title) ?> :(</h1>

            <div class="alert alert-danger">
                <?= nl2br(Html::encode($message)) ?>
            </div>

            <p>
                <?= t('The above error occurred while the  server was processing your request.') ?>
            </p>
            <p>
                <?= t('Please contact us if you think this is a server error. Thank you.') ?>
            </p>

        </div>
    </div>
</div>
