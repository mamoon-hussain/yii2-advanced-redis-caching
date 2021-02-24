<?php

use webvimark\modules\UserManagement\components\GhostHtml;
use webvimark\modules\UserManagement\models\rbacDB\Role;
use webvimark\modules\UserManagement\models\ZUser;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\enums\PasswordIds;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\ZUser $model
 */
$this->title = $model->username;

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h2 class="lte-hide-title"><?= $this->title ?></h2>

    <?php if (Yii::$app->session->hasFlash('flash_error')): ?>
        <div class="alert alert-danger" role="alert">
            <?= Yii::$app->session->getFlash('flash_error'); ?>
        </div>
    <?php endif; ?>
    <?php if (Yii::$app->session->hasFlash('flash_success')): ?>
        <div class="alert alert-success" role="alert">
            <?= Yii::$app->session->getFlash('flash_success'); ?>
        </div>
    <?php endif; ?>

    <div class="panel panel-default">
        <div class="panel-body">

            <p>
                <?= Html::a(t('Update'), ['update'], ['class' => 'btn btn-sm btn-primary']) ?>
                <?php Html::a('Change Password', ['change-own-password'], ['class' => 'btn btn-sm btn-warning']) ?>
            </p>


            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
//                    'id',
                    [
                        'attribute' => 'status',
                        'value' => ZUser::getStatusValue($model->status),
                    ],
                    'username',
                    // 'fname',
                    [
                        'attribute' => 'fname',
                        'value' => $model->fname,
                    ],
                    // 'lname',
                    [
                        'attribute' => 'lname',
                        'value' => $model->lname,
                    ],
                    [
                        'attribute' => 'email',
                        'value' => $model->email,
                    ],
                    'created_at:datetime',
                    'country',
                    'city',
                    'state',
                    'zip',
                    'tax_id',
                    'address',
                    'address_2',
//                    'updated_at:datetime',
                ],
            ])
            ?>

        </div>
    </div>
</div>

<?php if ($model->superadmin) { ?>
    <div class="panel panel-default" style="background: #dbf2ff">
        <div class="panel-body">
            <div class="col-xs-12">
                <h3 class="header smaller lighter green">Passwords Configuration</h3>

                <p></p>

                <a style="width: 19%;" href="<?= Yii::$app->urlManager->createUrl("/accounting/change-password") ?>" class="btn btn-default btn-app radius-4">
                    <i class="ace-icon fa fa-cog bigger-230"></i>
                    Accounting Password
                    <span class="badge badge-pink"></span>
                </a>
                <a style="width: 19%;" href="<?= Yii::$app->urlManager->createUrl("/accounting/change-config-password?id=".PasswordIds::container_back_password) ?>" class="btn btn-default btn-app radius-4">
                    <i class="ace-icon fa fa-cog bigger-230"></i>
                    Container Back Password
                    <span class="badge badge-pink"></span>
                </a>
                <a style="width: 19%;" href="<?= Yii::$app->urlManager->createUrl("/accounting/change-config-password?id=".PasswordIds::invoices_back_password) ?>" class="btn btn-default btn-app radius-4">
                    <i class="ace-icon fa fa-cog bigger-230"></i>
                    Invoices Edit Password
                    <span class="badge badge-pink"></span>
                </a>
                <a style="width: 19%;" href="<?= Yii::$app->urlManager->createUrl("/accounting/change-config-password?id=".PasswordIds::edit_inventory_prices) ?>" class="btn btn-default btn-app radius-4">
                    <i class="ace-icon fa fa-cog bigger-230"></i>
                    Inventory Edit Prices Password
                    <span class="badge badge-pink"></span>
                </a>
                <a style="width: 19%;" href="<?= Yii::$app->urlManager->createUrl("/accounting/change-config-password?id=".PasswordIds::edit_inventory) ?>" class="btn btn-default btn-app radius-4">
                    <i class="ace-icon fa fa-cog bigger-230"></i>
                    Inventory Edit/Update Password
                    <span class="badge badge-pink"></span>
                </a>
                <a style="width: 19%;" href="<?= Yii::$app->urlManager->createUrl("/accounting/change-config-password?id=".PasswordIds::delete_inventory) ?>" class="btn btn-default btn-app radius-4">
                    <i class="ace-icon fa fa-cog bigger-230"></i>
                    Inventory Delete Password
                    <span class="badge badge-pink"></span>
                </a>
                <a style="width: 19%;" href="<?= Yii::$app->urlManager->createUrl("/accounting/change-config-password?id=".PasswordIds::release_inventory) ?>" class="btn btn-default btn-app radius-4">
                    <i class="ace-icon fa fa-cog bigger-230"></i>
                    Release Inventory Password
                    <span class="badge badge-pink"></span>
                </a>
                <a style="width: 19%;" href="<?= Yii::$app->urlManager->createUrl("/accounting/change-config-password?id=".PasswordIds::unprint_bill) ?>" class="btn btn-default btn-app radius-4">
                    <i class="ace-icon fa fa-cog bigger-230"></i>
                    Unprint Bill Password
                    <span class="badge badge-pink"></span>
                </a>
                <a style="width: 19%;" href="<?= Yii::$app->urlManager->createUrl("/accounting/change-config-password?id=".PasswordIds::Default_Bills) ?>" class="btn btn-default btn-app radius-4">
                    <i class="ace-icon fa fa-cog bigger-230"></i>
                    Default Fees Password
                    <span class="badge badge-pink"></span>
                </a>
                <a style="width: 19%;" href="<?= Yii::$app->urlManager->createUrl("/accounting/change-config-password?id=".PasswordIds::Inland_Fees) ?>" class="btn btn-default btn-app radius-4">
                    <i class="ace-icon fa fa-cog bigger-230"></i>
                    Inland Fees Password
                    <span class="badge badge-pink"></span>
                </a>
                <a style="width: 19%;" href="<?= Yii::$app->urlManager->createUrl("/accounting/change-config-password?id=".PasswordIds::Loading_Fees) ?>" class="btn btn-default btn-app radius-4">
                    <i class="ace-icon fa fa-cog bigger-230"></i>
                    Loading Fees Password
                    <span class="badge badge-pink"></span>
                </a>
                <a style="width: 19%;" href="<?= Yii::$app->urlManager->createUrl("/accounting/change-config-password?id=".PasswordIds::Shipping_Fees) ?>" class="btn btn-default btn-app radius-4">
                    <i class="ace-icon fa fa-cog bigger-230"></i>
                    Shipping Fees Password
                    <span class="badge badge-pink"></span>
                </a>
                <a style="width: 19%;" href="<?= Yii::$app->urlManager->createUrl("/accounting/change-config-password?id=".PasswordIds::Other_Fees) ?>" class="btn btn-default btn-app radius-4">
                    <i class="ace-icon fa fa-cog bigger-230"></i>
                    Other Fees Password
                    <span class="badge badge-pink"></span>
                </a>
                <a style="width: 19%;" href="<?= Yii::$app->urlManager->createUrl("/accounting/change-config-password?id=".PasswordIds::Memo_Fees) ?>" class="btn btn-default btn-app radius-4">
                    <i class="ace-icon fa fa-cog bigger-230"></i>
                    Memo Fees Password
                    <span class="badge badge-pink"></span>
                </a>
            </div>
        </div>


    </div>
<?php } ?>

<style>
    .btn-app, .btn-app.btn-default, .btn-app.btn-default.disabled:hover, .btn-app.btn-default.no-hover:hover, .btn-app.disabled:hover, .btn-app.no-hover:hover {
        background: repeat-x #0065ae!important;
        background-image: -webkit-linear-gradient(top,#BCC9D5 0,#ABBAC3 100%)!important;
        background-image: -o-linear-gradient(top,#BCC9D5 0,#ABBAC3 100%)!important;
        background-image: linear-gradient(to bottom,#012c53 0,#ABBAC3 100%)!important;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffbcc9d5', endColorstr='#ffabbac3', GradientType=0)!important;
    }
</style>
