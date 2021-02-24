<?php

/**
 * @var $this yii\web\View
 * @var $user webvimark\modules\UserManagement\models\User
 */
use yii\helpers\Html;
use yii\widgets\DetailView;
use common\enums\RequestEnums;
use common\enums\RequestStatus;
use common\enums\RequestTypes;
use common\enums\PaymentMethod;

$adminUrl = str_replace('/en', '/admin/en', Yii::$app->urlManager->createAbsoluteUrl(['/']));
$adminUrl = str_replace('/ar', '/admin/ar', $adminUrl);


switch ($model->type) {
    case RequestTypes::product:
        $visibleProduct = true;
        $visiblePlace = false;
        break;

    case RequestTypes::place:
        $visibleProduct = false;
        $visiblePlace = true;
        break;
    default:
        break;
}
switch ($model->enums){
    case RequestEnums::painting:
        $name = t('Panting\'s name');
        break;

    case RequestEnums::tool:
        $name = t('Tool\'s name');
        break;
    case RequestEnums::hall:
        $name = t('Hall\'s name');
        break;
    case RequestEnums::package:
        $name = t('Package\'s name');
        break;
    case RequestEnums::course:
        $name = t('Course\'s name');
        break;
    default:
        break;
}
?>

<h1 style="text-align: center; color: #438eb9;"><?= Yii::$app->params['title'] ?></h1>

<p>Dear Admin,</p>
<p>A new request was made!</p>
<p>
    You can find more info on this
    <a href="<?= $adminUrl.'/request/view?id='.$model->id ?>">
        link
    </a>
</p>

<h3 style="color: red;">Request details: </h3>
<table style="margin-bottom: 10px;border-collapse: collapse;
       border-spacing: 0;
       width: 100%;
       max-width: 100%;border-radius: 0!important;border: 2px solid #000000 !important;
       text-transform: uppercase;  text-align: center;
       padding: 4px;
       vertical-align: middle;
       border-color: inherit;" class="table table-striped table-bordered">
    <tbody style="
           vertical-align: middle;
           border-color: inherit;">
    <tr>
        <th style="text-align: center;border: 2px solid #000000 !important;
                text-transform: uppercase;  text-align: center;
                padding: 4px;"><?= $model->getAttributeLabel('type') ?></th>
        <td style="text-align: center;border: 2px solid #000000 !important;
                    text-transform: uppercase;  text-align: center;
                    padding: 4px;"><?= RequestTypes::LabelOfStyle($model->type) ?></td>
    </tr>
    <tr>
        <th style="text-align: center;border: 2px solid #000000 !important;
                text-transform: uppercase;  text-align: center;
                padding: 4px;"><?= $model->getAttributeLabel('enums') ?></th>
        <td style="text-align: center;border: 2px solid #000000 !important;
                    text-transform: uppercase;  text-align: center;
                    padding: 4px;"><?= RequestEnums::LabelOfStyle($model->enums) ?></td>
    </tr>
    <tr>
        <th style="text-align: center;border: 2px solid #000000 !important;
                text-transform: uppercase;  text-align: center;
                padding: 4px;"><?= $model->getAttributeLabel('user_id') ?></th>
        <td style="text-align: center;border: 2px solid #000000 !important;
                    text-transform: uppercase;  text-align: center;
                    padding: 4px;"><?= $model->user->username ?></td>
    </tr>
    <tr>
        <th style="text-align: center;border: 2px solid #000000 !important;
                text-transform: uppercase;  text-align: center;
                padding: 4px;"><?= $model->getAttributeLabel('fname') ?></th>
        <td style="text-align: center;border: 2px solid #000000 !important;
                    text-transform: uppercase;  text-align: center;
                    padding: 4px;"><?= $model->fname ?></td>
    </tr>
    <tr>
        <th style="text-align: center;border: 2px solid #000000 !important;
                text-transform: uppercase;  text-align: center;
                padding: 4px;"><?= $model->getAttributeLabel('lname') ?></th>
        <td style="text-align: center;border: 2px solid #000000 !important;
                    text-transform: uppercase;  text-align: center;
                    padding: 4px;"><?= $model->lname ?></td>
    </tr>
    <tr>
        <th style="text-align: center;border: 2px solid #000000 !important;
                text-transform: uppercase;  text-align: center;
                padding: 4px;"><?= $model->getAttributeLabel('phone') ?></th>
        <td style="text-align: center;border: 2px solid #000000 !important;
                    text-transform: uppercase;  text-align: center;
                    padding: 4px;"><?= $model->phone ?></td>
    </tr>
    <tr>
        <th style="text-align: center;border: 2px solid #000000 !important;
                text-transform: uppercase;  text-align: center;
                padding: 4px;"><?= $model->getAttributeLabel('email') ?></th>
        <td style="text-align: center;border: 2px solid #000000 !important;
                    text-transform: uppercase;  text-align: center;
                    padding: 4px;"><?= $model->email ?></td>
    </tr>
    <?php if($visibleProduct){ ?>
        <tr>
            <th style="text-align: center;border: 2px solid #000000 !important;
                text-transform: uppercase;  text-align: center;
                padding: 4px;"><?= $model->getAttributeLabel('product_id') ?></th>
            <td style="text-align: center;border: 2px solid #000000 !important;
                    text-transform: uppercase;  text-align: center;
                    padding: 4px;"><?= $model->product->name ?></td>
        </tr>
    <?php } ?>
    <?php if($visiblePlace){ ?>
        <tr>
            <th style="text-align: center;border: 2px solid #000000 !important;
                text-transform: uppercase;  text-align: center;
                padding: 4px;"><?= $model->getAttributeLabel('place_id') ?></th>
            <td style="text-align: center;border: 2px solid #000000 !important;
                    text-transform: uppercase;  text-align: center;
                    padding: 4px;"><?= $model->place->name ?></td>
        </tr>
    <?php } ?>
    <tr>
        <th style="text-align: center;border: 2px solid #000000 !important;
                text-transform: uppercase;  text-align: center;
                padding: 4px;"><?= $model->getAttributeLabel('price') ?></th>
        <td style="text-align: center;border: 2px solid #000000 !important;
                    text-transform: uppercase;  text-align: center;
                    padding: 4px;"><?= $model->price.' '.t('KD') ?></td>
    </tr>
    <tr>
        <th style="text-align: center;border: 2px solid #000000 !important;
                text-transform: uppercase;  text-align: center;
                padding: 4px;"><?= $model->getAttributeLabel('payment_method') ?></th>
        <td style="text-align: center;border: 2px solid #000000 !important;
                    text-transform: uppercase;  text-align: center;
                    padding: 4px;"><?php
            $res = PaymentMethod::LabelOfStyle($model->payment_method);
            if($model->payment_method == PaymentMethod::paypal) {
                if ($model->isPayed) {
                    $res = $res . '<br/><span class=" badge badge-sm" style="margin-top: 3px;color: white; font-size: 17px;background-color: #53ff43">' .t('Payed').'</span>';
                } else {
                    $res = $res . '<br/><span class=" badge badge-sm" style="margin-top: 3px;color: white; font-size: 17px;background-color: #ff1100">' .t('Not Payed').'</span>';
                }
            }
            echo $res;
            ?></td>
    </tr>
    <tr>
        <th style="text-align: center;border: 2px solid #000000 !important;
                text-transform: uppercase;  text-align: center;
                padding: 4px;"><?= $model->getAttributeLabel('status') ?></th>
        <td style="text-align: center;border: 2px solid #000000 !important;
                    text-transform: uppercase;  text-align: center;
                    padding: 4px;"><?= RequestStatus::LabelOfStyle($model->status) ?></td>
    </tr>
    <?php if( (($model->enums==RequestEnums::package))){ ?>
        <tr>
            <th style="text-align: center;border: 2px solid #000000 !important;
                text-transform: uppercase;  text-align: center;
                padding: 4px;"><?= $model->getAttributeLabel('start_date') ?></th>
            <td style="text-align: center;border: 2px solid #000000 !important;
                    text-transform: uppercase;  text-align: center;
                    padding: 4px;"><?= date(\common\enums\Constents::date_format_view_3, strtotime($model->start_date)) ?></td>
        </tr>
    <?php } ?>
    <?php if( (($model->enums==RequestEnums::package))){ ?>
        <tr>
            <th style="text-align: center;border: 2px solid #000000 !important;
                text-transform: uppercase;  text-align: center;
                padding: 4px;"><?= $model->getAttributeLabel('start_date') ?></th>
            <td style="text-align: center;border: 2px solid #000000 !important;
                    text-transform: uppercase;  text-align: center;
                    padding: 4px;"><?= date(\common\enums\Constents::date_format_view_3, strtotime($model->start_date)) ?></td>
        </tr>
    <?php } ?>
    <?php if( (($model->enums==RequestEnums::package))){ ?>
        <tr>
            <th style="text-align: center;border: 2px solid #000000 !important;
                text-transform: uppercase;  text-align: center;
                padding: 4px;"><?= $model->getAttributeLabel('price_unit_number') ?></th>
            <td style="text-align: center;border: 2px solid #000000 !important;
                    text-transform: uppercase;  text-align: center;
                    padding: 4px;"><?= $model->price_unit_number ?></td>
        </tr>
    <?php } ?>
    <tr>
        <th style="text-align: center;border: 2px solid #000000 !important;
                text-transform: uppercase;  text-align: center;
                padding: 4px;"><?= $model->getAttributeLabel('created_date') ?></th>
        <td style="text-align: center;border: 2px solid #000000 !important;
                    text-transform: uppercase;  text-align: center;
                    padding: 4px;"><?= $model->created_date ?></td>
    </tr>
    <?php if($visibleProduct){ ?>
        <tr>
            <th style="text-align: center;border: 2px solid #000000 !important;
                text-transform: uppercase;  text-align: center;
                padding: 4px;"><?= $model->getAttributeLabel('image') ?></th>
            <td style="text-align: center;border: 2px solid #000000 !important;
                    text-transform: uppercase;  text-align: center;
                    padding: 4px;"><?= '<img class="img_view" src="'.$model->product->imageUrl.'" style="max-height: 200px;">' ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>


<?php if($model->requestDates){ ?>
    <div class="col-md-12">
        <h4><?= t('Requested Dates') ?></h4>
        <table style="margin-bottom: 10px;border-collapse: collapse;
       border-spacing: 0;
       width: 100%;
       max-width: 100%;border-radius: 0!important;border: 2px solid #000000 !important;
       text-transform: uppercase;  text-align: center;
       padding: 4px;
       vertical-align: middle;
       border-color: inherit;" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th><?= t('Date') ?></th>
                <th><?= t('Period') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($model->requestDates as $one){ ?>
                <tr>
                    <td style="text-align: center;border: 2px solid #000000 !important;
                    text-transform: uppercase;  text-align: center;
                    padding: 4px;"><?= $one->date ?></td>
                    <td style="text-align: center;border: 2px solid #000000 !important;
                    text-transform: uppercase;  text-align: center;
                    padding: 4px;"><?= \common\enums\ClassPeriod::LabelOfStyle($one->period) ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
<?php } ?>
