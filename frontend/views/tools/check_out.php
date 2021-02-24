
<?php
use yii\widgets\DetailView;
?>





<section class="form4 cid-si5k28crPG mbr-fullscreen" id="form4-11" style="margin-top: 100px">


    <div class="container">
        <div class="row content-wrapper justify-content-center">
            <div class="col-lg-3 offset-lg-1 mbr-form" data-form-type="formoid">
                <div class="mbr-form form-with-styler">
                    <div class="dragArea row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h1 class="mbr-section-title mb-4 display-2">
                                <strong><?= $model->name ?></strong>
                            </h1>
                        </div>
                        <div class="col-lg-12 col-md col-12 form-group">
                            <?= t('Price: '). $model->price. t('KD') ?>
                        </div>
                        <div class="col-lg-12 col-md col-12 form-group">
                            <?= t('Description: '). $model->description ?>
                        </div>

                        <div class="col-12 col-md-auto mbr-section-btn">
                            <a href="<?= Yii::$app->urlManager->createUrl("/site/create-product-request?id=".$model->id) ?>" class="btn btn-primary display-4"><?= t('Cash') ?></a>
                        </div>
                        <div class="col-12 col-md-auto mbr-section-btn">
                            <a href="<?= Yii::$app->urlManager->createUrl("/site/create-product-request?id=".$model->id) ?>" class="btn btn-primary display-4"><?= t('PayPal') ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 offset-lg-1 col-12">
                <div class="image-wrapper">
                    <img class="w-100" src="<?=$model->imageUrl ?>" alt="Mobirise">
                </div>
            </div>

            <div class="col-lg-12 mx-auto">
                <div class="user-form" style="width: 100%; ">
                    <div class="panel panel-default">
                        <div class="panel-body" >
                            <?=
                            DetailView::widget([
                                'model' => $user,
                                'attributes' => [
                                    'username',
                                    [
                                        'attribute' => 'fname',
                                        'label' => 'First Name',
                                        'value' => $user->fname,
                                    ],
                                    [
                                        'attribute' => 'lname',
                                        'label' => 'Last Name',
                                        'value' => $user->lname,
                                    ],
                                    [
                                        'attribute' => 'email',
                                        'value' => $user->email,
                                    ],
                                    [
                                        'attribute' => 'status',
                                        'value' => \webvimark\modules\UserManagement\models\ZUser::getStatusValue($user->status),
                                    ],
                                    'created_at:datetime',
                                ],

                            ])
                            ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
