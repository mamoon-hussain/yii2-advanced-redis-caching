<?php

namespace common\services;

use api\models\auth\LoginResult;
use api\models\auth\LoginResultApi;
use api\models\other\ApiMessage;
use api\models\other\ApiResult;
use common\enums\ActiveInactiveStatus;
use common\enums\Constents;
use common\enums\ErrorCode;
use common\enums\LoginApiEnum;
use common\enums\UserConfirmationType;
use common\models\Admin;
use common\models\AppInfo;
use common\models\PaymentModel;
use common\models\PaymentTransaction;
use common\models\Request;
use common\models\User;
use common\models\UserAddress;
use common\models\UserMobileEmail;
use PHPUnit\Runner\Exception;
use webvimark\modules\UserManagement\libs\LibUser;
use webvimark\modules\UserManagement\models\VUserMobileEmail;
use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;

class EmailService {

    public static function sendNotificationEmail($emailCompose, $title) {
        $from_title = Yii::$app->params['title'];
        $from_email = Yii::$app->params['adminEmail'];
        $about = AppInfo::find()->one();
        $to_email = $about->email;
//        $to_email = 'yusef.shahoud@gmail.com';

        $message = $emailCompose->setFrom([$from_email => $from_title])
            ->setTo($to_email)
            ->setSubject($from_title . ', '.$title);
        if($message->send()){
            return true;
        }
        return false;
    }

}