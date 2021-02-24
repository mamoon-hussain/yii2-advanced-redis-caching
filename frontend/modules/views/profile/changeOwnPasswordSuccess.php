<?php

use webvimark\modules\UserManagement\UserManagementModule;

/**
 * @var yii\web\View $this
 */

$this->title = t( 'Change own password');
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="header10 cid-si3gh69yvp mbr-fullscreen" id="header10-7" style="background-image: url('<?= imageUrl('/mbr-1920x1281.jpg') ?>');">
    <div class="align-center container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-9">
                <h1 class="mbr-section-title mbr-fonts-style mb-3 display-1"><strong><?= $this->title ?></strong></h1>
            </div>
        </div>
    </div>
</section>

<div class="" style="padding: 0 5%;margin-top:50px">
    <div class="mx-auto " style="    margin-bottom: 25px">

        <div class="container" >

<!--            --><?//= UserManagementModule::t('back', 'Password has been changed') ?>
            <h1 class="login-class" style="margin-bottom: 15px; text-align: center"><?=t('Password has been changed') ?></h1>
        <a href="<?= Yii::$app->urlManager->createUrl("/") ?>" class="recovery-password btn btn-lg btn-primary btn-block">
            <i class="fa fa-home"></i><?= t('Home') ?>
        </a>

        </div>
    </div>
</div>

