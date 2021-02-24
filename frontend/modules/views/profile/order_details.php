<?php

use common\models\Supermarket;
use yii\widgets\DetailView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\enums\Constents;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\enums\ActiveInactiveStatus;

$this->title = t('Checkout');

$deliveryModel = $model->deliveryAddress;
$billingModel = $model->billingAddress;
?>

<div class="modal-header">
    <h4 class="modal-title"><?= $title ?></h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span></button>

</div>
<div class="modal-body">
    <section class="ftco-section testimony-section bg-light" style="padding: 3% 0%;">
        <div class="overlay"></div>
        <div class="container">
            <div class="row ftco-animate fadeInUp ftco-animated">
                <?php
                if(count($model->orderProductsByStore) > 1){
                    $col = 6;
                } else {
                    $col = 12;
                }
                foreach ($model->orderProductsByStore as $oneStore){
                    $storeDetails = Supermarket::findOne($oneStore['id']);
                    if($storeDetails){
                        ?>
                        <div class="col-md-<?= $col ?>">
                            <div class="item">
                                <div class="testimony-wrap py-4">
                                    <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-shopping-cart"></span></div>
                                    <div class="text">
                                        <table class="table">
                                            <tbody id="supermarket_table_<?= $oneStore['id'] ?>">
                                            <tr>
                                                <th><?= t('Product') ?></th>
                                                <th><?= t('Qty') ?></th>
                                            </tr>
                                            <?php
                                            if(isset($oneStore['product'])){
                                                foreach ($oneStore['product'] as $key => $one){ ?>
                                            <tr>
                                                <td>
                                                    <?= $one['name'] ?>
                                                </td>
                                                <td>
                                                    <?= $one['qty'] ?>
                                                </td>
                                            </tr>

                                                <?php }
                                            } ?>
                                            </tbody>
                                        </table>
                                        <div class="d-flex align-items-center">
                                            <div class="user-img" style="background-image: url(<?= $storeDetails->imageUrl ?>)"></div>
                                            <div class="pl-3">
                                                <p class="name"><?= $storeDetails->name ?></p>
                                                <span class="position"><?= $storeDetails->category->name ?> </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </section>
    <section class="ftco-section bg-light" style="padding: 2% 0%;">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-6 ftco-animate fadeInUp ftco-animated">
                    <div class="block-7">
                        <div class="text-center">
                            <span class="excerpt d-block"><?= t('Delivery Info') ?></span>
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th><?= $deliveryModel->getAttributeLabel('title') ?></th>
                                    <td><?= $deliveryModel->title ?></td>
                                </tr>
                                <tr>
                                    <th><?= $deliveryModel->getAttributeLabel('first_name') ?></th>
                                    <td><?= $deliveryModel->first_name ?></td>
                                </tr>
                                <tr>
                                    <th><?= $deliveryModel->getAttributeLabel('last_name') ?></th>
                                    <td><?= $deliveryModel->last_name ?></td>
                                </tr>
                                <tr>
                                    <th><?= $deliveryModel->getAttributeLabel('address_1') ?></th>
                                    <td><?= $deliveryModel->address_1 ?></td>
                                </tr>
                                <tr>
                                    <th><?= $deliveryModel->getAttributeLabel('address_2') ?></th>
                                    <td><?= $deliveryModel->address_2 ?></td>
                                </tr>
                                <tr>
                                    <th><?= $deliveryModel->getAttributeLabel('block') ?></th>
                                    <td><?= $deliveryModel->block ?></td>
                                </tr>
                                <tr>
                                    <th><?= $deliveryModel->getAttributeLabel('floor') ?></th>
                                    <td><?= $deliveryModel->floor ?></td>
                                </tr>
                                <tr>
                                    <th><?= $deliveryModel->getAttributeLabel('door_number') ?></th>
                                    <td><?= $deliveryModel->door_number ?></td>
                                </tr>
                                <tr>
                                    <th><?= $deliveryModel->getAttributeLabel('phone') ?></th>
                                    <td><?= $deliveryModel->phone ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 ftco-animate fadeInUp ftco-animated">
                    <div class="block-7">
                        <div class="text-center">
                            <span class="excerpt d-block"><?= t('Billing Info') ?></span>
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th><?= $billingModel->getAttributeLabel('title') ?></th>
                                    <td><?= $billingModel->title ?></td>
                                </tr>
                                <tr>
                                    <th><?= $billingModel->getAttributeLabel('first_name') ?></th>
                                    <td><?= $billingModel->first_name ?></td>
                                </tr>
                                <tr>
                                    <th><?= $billingModel->getAttributeLabel('last_name') ?></th>
                                    <td><?= $billingModel->last_name ?></td>
                                </tr>
                                <tr>
                                    <th><?= $billingModel->getAttributeLabel('address_1') ?></th>
                                    <td><?= $billingModel->address_1 ?></td>
                                </tr>
                                <tr>
                                    <th><?= $billingModel->getAttributeLabel('address_2') ?></th>
                                    <td><?= $billingModel->address_2 ?></td>
                                </tr>
                                <tr>
                                    <th><?= $billingModel->getAttributeLabel('block') ?></th>
                                    <td><?= $billingModel->block ?></td>
                                </tr>
                                <tr>
                                    <th><?= $billingModel->getAttributeLabel('floor') ?></th>
                                    <td><?= $billingModel->floor ?></td>
                                </tr>
                                <tr>
                                    <th><?= $billingModel->getAttributeLabel('door_number') ?></th>
                                    <td><?= $billingModel->door_number ?></td>
                                </tr>
                                <tr>
                                    <th><?= $billingModel->getAttributeLabel('phone') ?></th>
                                    <td><?= $billingModel->phone ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12 col-lg-12 ftco-animate fadeInUp ftco-animated">
                    <div class="block-7">
                        <span class="excerpt d-block"><?= t('Email') ?></span>
                        <p><?= $model->email ?></p>
                        <span class="excerpt d-block"><?= t('Notes') ?></span>
                        <p><?= $model->notes ? $model->notes : t('(Not Set)') ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-warning" data-dismiss="modal"><?= \Yii::t('all', 'Close') ?></button>
</div>




