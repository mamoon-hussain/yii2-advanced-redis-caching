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
?>

<h1 style="text-align: center; color: #438eb9;"><?= Yii::$app->params['title'] ?></h1>

<p>Dear Admin,</p>
<p>A new user just registered in site.</p>

<h3 style="color: red;">User details: </h3>
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
    </tbody>
</table>


