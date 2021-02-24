<a href="<?= Yii::$app->urlManager->createUrl("/user/profile/orders") ?>" class="services-2 w-100 d-flex">
    <div class="icon d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;">
        <span class="fa fa-shopping-cart" style="font-size: 20px;"></span></div>
    <div class="text pl-4">
        <h4><?= t('Orders') ?></h4>
    </div>
</a>
<a href="<?= Yii::$app->urlManager->createUrl("/user/profile/delivery-address") ?>" class="services-2 w-100 d-flex">
    <div class="icon d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;">
        <span class="fa fa-building" style="font-size: 20px;"></span></div>
    <div class="text pl-4">
        <h4><?= t('Delivery Address') ?></h4>
    </div>
</a>
<a href="<?= Yii::$app->urlManager->createUrl("/user/profile/billing-address") ?>" class="services-2 w-100 d-flex">
    <div class="icon d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;">
        <span class="fa fa-money" style="font-size: 20px;"></span></div>
    <div class="text pl-4">
        <h4><?= t('Billing Address') ?></h4>
    </div>
</a>
<a href="<?= Yii::$app->urlManager->createUrl("/user/profile") ?>" class="services-2 w-100 d-flex">
    <div class="icon d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;">
        <span class="fa fa-user" style="font-size: 20px;"></span></div>
    <div class="text pl-4">
        <h4><?= t('Profile') ?></h4>
    </div>
</a>
<a href="<?= Yii::$app->urlManager->createUrl("/user/profile/update") ?>" class="services-2 w-100 d-flex">
    <div class="icon d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;">
        <span class="fa fa-edit" style="font-size: 20px;"></span></div>
    <div class="text pl-4">
        <h4><?= t('Update') ?></h4>
    </div>
</a>
<a href="<?= Yii::$app->urlManager->createUrl("/user/profile/change-own-password") ?>" class="services-2 w-100 d-flex">
    <div class="icon d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;">
        <span class="fa fa-lock" style="font-size: 20px;"></span></div>
    <div class="text pl-4">
        <h4><?= t('Change Password') ?></h4>
    </div>
</a>
<a href="<?= Yii::$app->urlManager->createUrl("/user/auth/logout") ?>" class="services-2 w-100 d-flex">
    <div class="icon d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;">
        <span class="fa fa-sign-out" style="font-size: 20px;"></span></div>
    <div class="text pl-4">
        <h4><?= t('Logout') ?></h4>
    </div>
</a>
