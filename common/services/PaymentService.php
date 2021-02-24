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

class PaymentService extends LibUser {

    public static function payment(Request $request, $product_name) {
        $fields = array(
            'merchant_id'=>'1201',
            'username' => 'test',
            'password'=>stripslashes('test'),
            'api_key'=>'jtest123', // in sandbox request
            //'api_key' =>password_hash('API_KEY',PASSWORD_BCRYPT), //In production mode, please pass API_KEY with BCRYPT function
            'order_id'=>$request->id, // MIN 30 characters with strong unique function (like hashing function with time)
            'total_price'=>$request->price * $request->price_unit_number,
            'CurrencyCode'=>'KWD',//only works in production mode
            'CstFName'=>$request->user->fullName,
            'CstEmail'=>$request->user->email,
            'CstMobile'=>$request->user->phone,
            'success_url'=>Url::to(['/request/payment-response?id='.$request->id], true),
            'error_url'=>Url::to(['/request/payment-response?id='.$request->id], true),
            'test_mode'=>1, // test mode enabled
            'whitelabled'=>true, // only accept in live credentials (it will not work in test)
//            'payment_gateway'=>'knet',// only works in production mode
            'ProductName'=>json_encode([$product_name]),
            'ProductQty'=>json_encode([$request->price_unit_number]),
            'ProductPrice'=>json_encode([$request->price]),
            'reference'=>'Ref00'.$request->id
        );

        $fields_string = http_build_query($fields);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://api.upayments.com/test-payment");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$fields_string);
// receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        $server_output = json_decode($server_output,true);
        if($server_output['status'] != 'success'){
            stopv($server_output);
        }
        return $server_output['paymentURL'];
    }

    public static function sendPaymentEmail($email, $model) {
        return Yii::$app->mailer->compose('@frontend/views/email/payment_email', [
            'model' => $model,
        ])
            ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->params['title']])
            ->setTo($email)
            ->setSubject(Yii::t('all', Yii::$app->params['title']) .' '.Yii::t('all', 'Payment Confirmed'))
            ->send();
    }
}