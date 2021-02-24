

<header class="masthead" style="background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.7) 75%, #000000 100%)">
    <div class="container d-flex h-100 align-items-center">
        <div class="mx-auto text-center">
            <h1 class="mx-auto my-0 text-uppercase">
                <div style="margin: 25px 25px" >
                    <img  src="<?=$model->imageUrl ?>">
                </div>
            </h1>
            <a class="btn btn-primary js-scroll-trigger" href="<?= Yii::$app->urlManager->createUrl("/site/create-place-request?id=".$model->id) ?>"> <?= t('make request') ?></a>
            <a class="btn btn-primary js-scroll-trigger" href="#about"><?= t('Get Started') ?></a>

        </div>
    </div>
</header>
