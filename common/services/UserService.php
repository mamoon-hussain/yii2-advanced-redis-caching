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
use common\models\User;
use common\models\UserAddress;
use common\models\UserMobileEmail;
use webvimark\modules\UserManagement\libs\LibUser;
use webvimark\modules\UserManagement\models\VUserMobileEmail;
use Yii;
use yii\web\UploadedFile;

class UserService extends LibUser {

    const Msg_RegistrationSuccess = "Please Enter the Confirmation Code you will receive via Email to confirm your account.";
    const Msg_RegistrationSuccessForgetPassword = "Please Enter the Confirmation Code you will receive via Email to confirm changing your password.";
    const Msg_RegistrationSuccessForgetPasswordPhone = "Please Enter the Confirmation Code you will receive via SMS to confirm changing your password.";
    const facebook_graph_base_url = 'https://graph.facebook.com/';

    public static function profileCreate($post, $code = '') {
        $model = new User;
//        stopv($model->attributes());

        $model->scenario = User::scenario_createByUser;
        $model->load(["User" => $post]);
        if(!$model->fname){
            $model->fname = isset($post['first_name']) ? $post['first_name'] : '';
        }
        if(!$model->lname){
            $model->lname = isset($post['last_name']) ? $post['last_name'] : '';
        }

        if(!$model->username){
            $model->username = $model->phone;
        }

        $model->password_hash = self::setPassword($post["password"]);
        $model->status = User::STATUS_INACTIVE;
        $model->mobile_confirmed = '0';
        $model->email_confirmed = '0';

        $model->generateConfirmationToken();
        $model->generateAuthKey();
        $model->rate_count = 1;
        $model->created_at = time();
        $model->updated_at = time();
        if(!$model->save())
        {
            stopv($model->errors);
        }

        $errors = [];
        $t = \Yii::$app->db->beginTransaction();
        if (($result = $model->save())) {

            list($result_mobile, $model_mobile) = UserService::addUserMobileEmail($model->id,["UserMobileEmail"=>["mobile"=>$model->phone]], 1, $code);
        }
        $msg = [];
        foreach ($model->errors as $error) {
            $msg[] = isset($error[0]) ? $error[0] : '';
        }
        if ($result) {
            foreach (( (array) Yii::$app->getModule('user')->rolesAfterRegistration) as $role) {
                User::assignRole($model->id, $role);
            }
        }
        $result ? $t->commit() : $t->rollBack();
        return [$result, $model, $result ? t(UserService::Msg_RegistrationSuccess) : $msg];
    }

//    public static function profileCreate($post, $code = '') {
//        $model = new User;
//        $model->scenario = User::scenario_createByUser;
//        $model->load(["User" => $post]);
//        $model->fname = isset($post['first_name']) ? $post['first_name'] : '';
//        $model->lname = isset($post['last_name']) ? $post['last_name'] : '';
//
//        $model->password_hash = self::setPassword($post["password"]);
//        $model->status = User::STATUS_INACTIVE;
//        $model->mobile_confirmed = '1';
//        $model->generateConfirmationToken();
//        $model->created_at = time();
//        $model->updated_at = time();
//        $errors = [];
//        $t = \Yii::$app->db->beginTransaction();
//        if (($result = $model->save())) {
//
//            list($result_mobile, $model_mobile) = UserService::addUserMobileEmail($model->id,["UserMobileEmail"=>["email"=>$model->email]], 1, $code);
//        }
//        stopv($result);
//        $msg = [];
//        foreach ($model->errors as $error) {
//            $msg[] = isset($error[0]) ? $error[0] : '';
//        }
//        if ($result) {
//            foreach (( (array) Yii::$app->getModule('user')->rolesAfterRegistration) as $role) {
//                User::assignRole($model->id, $role);
//            }
//        }
//        $result ? $t->commit() : $t->rollBack();
//        return [$result, $model, $result ? t(UserService::Msg_RegistrationSuccess) : $msg];
//    }


    public static function apiProfileCreate($request) {
        $msg = [];
        if(!$request->email || !$request->password || !$request->first_name || !$request->last_name){
            throw new \yii\web\HttpException(200, t('Missing data!'), 200);
        }

        $data = [];
        //find user by email
        $user = User::find()->andWhere(['email' => $request->email])->one();
        //

        $result = false;
        $can_continue = true;

        if($user){
            http_response_code(200);
            $msg[] = ('Email already in use!');
        } elseif($can_continue) {
            $post = (array)$request;
            $post['username'] = $request->first_name;
            list($result, $user, $msg) = self::profileCreate($post, true);
        }
        $data = FillApiModelService::FillApiResultRegisterResultModel($user, UserService::Msg_RegistrationSuccess);

        return [$result, $data, $msg];
    }

    public static function profileUpdate($post) {
        $model = user();
        $model->scenario = User::scenario_updateByUser;

        if ($model->load($post)) {

            if (!is_null(UploadedFile::getInstance($model, 'imagefile'))) {
                $model->imagefile = UploadedFile::getInstance($model, 'imagefile');
                $model->uploadImage($model) ? "" : $model->addError('imagefile', 'sth went wrong');
            }
            return [$model->save(), $model];
        } else {
            return [false, $model];
        }
    }

    public static function loginPhoneEmailValidation($phone_email, $password) {
        $is_ok = true;
        if(!$phone_email || !$password){
            throw new \yii\web\HttpException(200, t('Missing data!'), 200);
        }

        if (!filter_var($phone_email, FILTER_VALIDATE_EMAIL)) {
            throw new \yii\web\HttpException(200, t('E-mail is not a valid email address.'), 200);
        }

        $login_model = new LoginResult();
        $login_model->token = '';

        $user = User::find()
            ->where(['email' => $phone_email])
//            ->orWhere(['email' => $phone_email])
            ->one();
        if (!($user)) {
            $login_model->resultCode = LoginApiEnum::not_found;
            $login_model->resultText = LoginApiEnum::LabelOf($login_model->resultCode);
        } elseif (!Yii::$app->getSecurity()->validatePassword($password, $user->password_hash)) {
            $login_model->resultCode = LoginApiEnum::invalid_password;
            $login_model->resultText = LoginApiEnum::LabelOf($login_model->resultCode, false, api_lang());
        } elseif ($user->status == User::STATUS_BANNED) {
            $login_model->resultCode = LoginApiEnum::banned;
            $login_model->resultText = LoginApiEnum::LabelOf($login_model->resultCode);
        }
        elseif (!$user->email_confirmed) {
            $login_model->resultCode = LoginApiEnum::not_confirmed;
            $login_model->resultText = LoginApiEnum::LabelOf($login_model->resultCode);
        } elseif ($user->status == User::STATUS_INACTIVE) {
            $login_model->resultCode = LoginApiEnum::not_active;
            $login_model->resultText = LoginApiEnum::LabelOf($login_model->resultCode);
        } else {
            $user->setAuthKey;
            $login_model->resultCode = LoginApiEnum::accepted;
            $login_model->resultText = LoginApiEnum::LabelOf($login_model->resultCode);
            $login_model->token = UserService::profile($user->id)->auth_key;
            $login_model->profile = FillApiModelService::FillProfileResultModel($user);
        }

        $res = new LoginResultApi([
            'result' => $login_model,
            'isOk' => $is_ok,
            'message' => new ApiMessage([
                'type' => 'Success',
                'code' => ErrorCode::success,
                'content' => '',
            ])
        ]);
        return $res;
    }

    public static function orderProfileCreate($post) {
        $model = User::find()
            ->andWhere(['email' => $post['email']])
            ->one();
        if(!$model){
            $model = new User();
            $model->load(["User" => $post]);
            $password = uniqid();
            $model->password_hash = self::setPassword($password);
            $model->status = User::STATUS_ACTIVE;
            $model->mobile_confirmed = '1';
            $model->generateConfirmationToken();
            if (($result = $model->save())) {
                list($result_mobile, $model_mobile) = UserService::addUserMobileEmail($model->id,["UserMobileEmail"=>["email"=>$model->email]], 1, '', $password);
            }
        } else {
            $result = true;
        }
        return [$result, $model];
    }

    public static function addUserMobileEmail($user_id, $request, $is_primary = 0, $code = '', $sendUserPass = '') {
        $model = new UserMobileEmail();

        if ($model->load($request)) {
            $model->confirm_code = rand(10000, 99999);
            $model->is_confirmed = 0;

            if(isset($request['UserMobileEmail']['mobile'])){
                $model->mobile = $request['UserMobileEmail']['mobile'];
            }
            if(isset($request['UserMobileEmail']['email'])){
                $model->email = $request['UserMobileEmail']['email'];
            }
            $model->is_primary = $is_primary;
            $model->type = UserConfirmationType::mobile_confirm;
            $model->user_id = $user_id;
            $model->save();
//        UserService::sendCodePhone($model);
            if($sendUserPass){
                $model->sendConfirmationPassEmail($sendUserPass);
            } else {
                if($code){
                    stopv('yyy');
                    $model->sendConfirmationEmail(UserConfirmationType::mobile_confirm);
                } else {

                    $model->sendConfirmationCodePhone(UserConfirmationType::mobile_confirm);
                }
            }

        }

        return [$model->save(), $model];
    }

//    public static function addUserMobileEmail($user_id, $request, $is_primary = 0, $code = '', $sendUserPass = '') {
//        $model = new UserMobileEmail();
//
//        if ($model->load($request)) {
//            $model->confirm_code = rand(10000, 99999);
//            $model->is_confirmed = 0;
//            if(isset($request['VUserMobileEmail']['email'])){
//                $model->email = $request['VUserMobileEmail']['email'];
//            }
//            if(isset($request['UserMobileEmail']['email'])){
//                $model->email = $request['UserMobileEmail']['email'];
//            }
//            $model->is_primary = $is_primary;
//            $model->type = UserConfirmationType::email_confirm;
//            $model->user_id = $user_id;
//            $model->save();
//
////        UserService::sendCodePhone($model);
//            if($sendUserPass){
//                stopv('xxx');
//
//                $model->sendConfirmationPassEmail($sendUserPass);
//            } else {
//                if($code){
//                    stopv('zzz');
//
//                    $model->sendConfirmationCodeEmail(UserConfirmationType::email_confirm);
//                } else {
//                    stopv('www');
//
//                    $model->sendConfirmationEmail();
//                }
//            }
//
//        }
//
//        return [$model->save(), $model];
//    }



    public static function addUserAddress($user_id, $type = 1, $title = '', $first_name = '', $last_name = '', $address_1 = '', $address_2 = '',
                                            $block = '', $floor = '', $door_number = '', $phone = '') {
        $model = UserAddress::find()
            ->andWhere(['user_id' => $user_id])
            ->andWhere(['type' => $type])
            ->one();
        if(!$model){
            $model = new UserAddress();
            $model->user_id = $user_id;
            $model->type = $type;
            $model->title = $title;
            $model->first_name = $first_name;
            $model->last_name = $last_name;
            $model->address_1 = $address_1;
            $model->address_2 = $address_2;
            $model->block = $block;
            $model->floor = $floor;
            $model->door_number = $door_number;
            $model->phone = $phone;

            if(!$model->save()){
                stopv($model->errors);
            }
        }
       return true;
    }

    public static function confirmUserEmail($email, $code, $type = UserConfirmationType::email_confirm) {
        $model = UserMobileEmail::find()
            ->andWhere(['email' => $email])
            ->andWhere(['type' => $type])
            ->one();
        $res = '';
        if(!$model){
            throw new \yii\web\HttpException(200, "Email not found", 200);
        }
        if($model->is_confirmed){
            throw new \yii\web\HttpException(200, "Email already confirmed", 200);
        }
        if($model->confirm_code != $code){
            throw new \yii\web\HttpException(200, "Wrong confirmation code", 200);
        } else {
            $user = User::findOne($model->user_id);
            if(!$user){
                throw new \yii\web\HttpException(200, "User not found", 200);
            }
            $model->is_confirmed = 1;
            if(!$model->save()) {
                throw new \yii\web\HttpException(200, "Error saving email", 200);
            }
            $user->email = $model->email;
            $user->email_confirmed = 1;
            $user->status = User::STATUS_ACTIVE;
            if(!$user->save()) {
                throw new \yii\web\HttpException(200, "Error saving user", 200);
            }

            //delete other emails
            $models = UserMobileEmail::find()
                ->andWhere(['user_id' => $model->user_id])
                ->andWhere(['not', ['email' => $email]])
                ->andWhere(['type' => $type])
                ->all();
            foreach ($models as $one){
                $one->delete();
            }

            //
            $login_model = new LoginResult();
            $user->setAuthKey;
            $is_ok = true;
            $login_model->resultCode = LoginApiEnum::accepted;
            $login_model->resultText = LoginApiEnum::LabelOf($login_model->resultCode);
            $login_model->token = $user->auth_key;
            $login_model->profile = FillApiModelService::FillProfileResultModel($user);
            $res = new LoginResultApi([
                'result' => $login_model,
                'isOk' => $is_ok,
                'message' => new ApiMessage([
                    'type' => 'Success',
                    'code' => ErrorCode::success,
                    'content' => '',
                ])
            ]);
        }
        return $res;
    }

    public static function userChangeOwnPassword($request) {
//        if (!$request->newPassword || (strlen($request->newPassword) < 8)) {
//            throw new \yii\web\HttpException(200, t('Password should contain at least 8 characters.'), 200);
//        }

        $model = user();
        $data = [];
        if ($model) {
            if (!$model->need_password && !Yii::$app->security->validatePassword($request->oldPassword, $model->password_hash)) {
                throw new \yii\web\HttpException(200, "Wrong old password", 200);
            }
            //change password
            $model->password_hash = self::setPassword($request->newPassword);
            $model->need_password = 0;
            if(!$model->save()) {
                throw new \yii\web\HttpException(200, "Error saving user", 200);
            } else {
                $data = new ApiResult([
                    'isOk' => true,
                    'message' => new ApiMessage([
                        'type' => 'Success',
                        'code' => ErrorCode::success,
                        'content' => t('Password Changed', [], api_lang()),
                    ]),
                ]);
            }
        } else {
            throw new \yii\web\HttpException(200, "User not found", 200);
        }
        return $data;
    }

    public static function UserForgetPassword($phone = '', $email = '') {
        $user = User::find();
        if($phone){
            $user = $user->andWhere(['phone' => $phone]);
        } else {
            $user = $user->andWhere(['email' => $email]);
        }
//        $user = $user->andWhere(['status' => User::STATUS_ACTIVE])
//            ->one();
        $user = $user->one();

        if(!$user){
            throw new \yii\web\HttpException(200, "User not found", 200);
        }

        $model = UserMobileEmail::find();
        if($phone){
            $model = $model->andWhere(['mobile' => $phone])
                ->andWhere(['type' => UserConfirmationType::forgot_password]);
        } else {
            $model = $model->andWhere(['email' => $email])
                ->andWhere(['type' => UserConfirmationType::forgot_password_email]);
        }
        $model = $model->andWhere(['is_confirmed' => 0])
            ->one();

        if(!$model){
            $model = new UserMobileEmail([
                'confirm_code' => rand(10000, 99999),
                'is_confirmed' => 0,
                'is_primary' => 0,
                'user_id' => $user->id,
            ]);
            if($phone){
                $model->mobile = $phone;
                $model->type = UserConfirmationType::forgot_password;
            } else {
                $model->email = $email;
                $model->type = UserConfirmationType::forgot_password_email;
            }
            if (!$model->save()) {
                throw new \yii\web\HttpException(200, "Forget password model not saved", 200);
            }
        }

        //send code
        if($phone){
            $msg = UserService::Msg_RegistrationSuccessForgetPasswordPhone;
            UserService::sendCodePhone($model);
        } else {
            $msg = UserService::Msg_RegistrationSuccessForgetPassword;
            UserService::sendCodeEmail($model, $model->type);
        }
        $success = api_success_msg($msg);
        return $success;
    }

    public static function sendCodeEmail(UserMobileEmail $model, $type = UserConfirmationType::email_confirm) {
        //add email code
        $model->sendConfirmationCodeEmail($type);
        return true;
    }

    public static function UserForgetPasswordConfirm($phone = '', $email = '', $code, $password) {
//        if (!$password || (strlen($password) < 8)) {
//            throw new \yii\web\HttpException(200, t('Password should contain at least 8 characters.'), 200);
//        }

        $user = User::find();
        if($phone){
            $user = $user->andWhere(['phone' => $phone]);
        } else {
            $user = $user->andWhere(['email' => $email]);
        }
        $user = $user->andWhere(['status' => User::STATUS_ACTIVE])
            ->one();
        if(!$user){
            throw new \yii\web\HttpException(200, "User not found", 200);
        }

        $model = UserMobileEmail::find();
        if($phone){
            $model = $model->andWhere(['mobile' => $phone])
                ->andWhere(['type' => UserConfirmationType::forgot_password]);
        } else {
            $model = $model->andWhere(['email' => $email])
                ->andWhere(['type' => UserConfirmationType::forgot_password_email]);
        }
        $model = $model->andWhere(['is_confirmed' => 0])
            ->one();
        if(!$model){
            throw new \yii\web\HttpException(200, "Forget password request not found!", 200);
        }

        if($model->confirm_code != $code){
            throw new \yii\web\HttpException(200, "Wrong confirmation code", 200);
        } else {
            $model->is_confirmed = 1;
            if(!$model->save()) {
                stopv($model->errors);
                throw new \yii\web\HttpException(200, "Error saving phone", 200);
            }

            //change password
            $user->password_hash = self::setPassword($password);
            if(!$user->save()) {
                throw new \yii\web\HttpException(200, "Error saving user", 200);
            }
        }
        $success = api_success_msg('Password Changed');
        return $success;
    }

    public static function apiLogOut($user) {
        //change auth token
        $user->setNewAuthKey;
        Yii::$app->user->logout();
        $data = api_success_msg('Logout success');
        return $data;
    }

    public static function resendCode($username, $codeType) {
        $model = UserMobileEmail::find();
        switch ($codeType){
            case UserConfirmationType::email_confirm:
                $user = User::find()
                    ->andWhere(['email' => $username])
                    ->one();
                if(!$user){
                    throw new \yii\web\HttpException(200, "User not found", 200);
                }
                $model = $model
                    ->andWhere(['email' => $username])
                    ->andWhere(['type' => UserConfirmationType::email_confirm]);
                break;

            case UserConfirmationType::forgot_password:
                $user = User::find()
                    ->andWhere(['phone' => $username])
                    ->one();
                if(!$user){
                    throw new \yii\web\HttpException(200, "User not found", 200);
                }
                $model = $model
                    ->andWhere(['mobile' => $username])
                    ->andWhere(['type' => UserConfirmationType::forgot_password]);
                break;

            case UserConfirmationType::forgot_password_email:
                $user = User::find()
                    ->andWhere(['email' => $username])
                    ->one();
                if(!$user){
                    throw new \yii\web\HttpException(200, "User not found", 200);
                }
                $model = $model->andWhere(['email' => $username])
                    ->andWhere(['type' => UserConfirmationType::forgot_password_email]);
                break;

            default:
                throw new \yii\web\HttpException(200, "Code not found", 200);
                break;
        }
        $model = $model->andWhere(['is_confirmed' => 0])
            ->one();
        if($model){
            //change code
            $model->confirm_code = rand(10000, 99999);
            if(!$model->save()){
                throw new \yii\web\HttpException(200, "Error saving code", 200);
            }
            //
            switch ($codeType) {
                case UserConfirmationType::email_confirm:
                case UserConfirmationType::forgot_password:
//                    UserService::sendCodePhone($model);
                    UserService::sendCodeEmail($model, $model->type);
                    break;
                case UserConfirmationType::forgot_password_email:
                    UserService::sendCodeEmail($model, $model->type);
                    break;
            }
        } else {
            throw new \yii\web\HttpException(200, "Code not found", 200);
        }

        $data = api_success_msg('Code Resent');
        return $data;
    }

    public static function userProfileUpdate($request) {
        $model = user();
        $model->scenario = Admin::scenario_updateByUser;
        $data = [];
        if ($model) {
            $model->fname = (isset($request->first_name) && $request->first_name) ? $request->first_name : $model->fname;
            $model->lname = (isset($request->last_name) && $request->last_name) ? $request->last_name : $model->lname;
            $model->address = isset($request->address) ? $request->address : $model->address;

            if(isset($request->birthDate)){
                $model->birth_date = ($request->birthDate) ? date(Constents::full_date_format, strtotime($request->birthDate)) : $request->birthDate;
            }
            $model->phone = isset($request->phone) ? $request->phone : null;
            if (!is_null(UploadedFile::getInstanceByName('image'))) {
                $model->imagefile = UploadedFile::getInstanceByName('image');
                $model->uploadImage($model) ? "" : $model->addError('imagefile', 'sth went wrong');
            }
            if(!$model->save()){
                throw new \yii\web\HttpException(200, "Error saving user", 200);
            } else {
//                $data = FillApiModelService::FillProfileModel($model);
//                $data = api_success_msg('Profile updated');
                $data = FillApiModelService::FillProfileResultModel(user());
            }
        } else {
            throw new \yii\web\HttpException(200, "User not found", 200);
        }
        return $data;
    }

    public static function editUserAddress($request, $type) {
        $model = user();
        $data = [];
        if ($model) {
            $addressModel = UserAddress::find()
                ->andWhere(['user_id' => $model->id])
                ->andWhere(['type' => $type])
                ->one();
            if(!$addressModel){
                $addressModel = new UserAddress();
                $addressModel->user_id = $model->id;
                $addressModel->type = $type;
            }
            $addressModel->load(['UserAddress' => (array)$request]);
            if(!$addressModel->save()){
                throw new \yii\web\HttpException(200, "Error saving address", 200);
            } else {
                $data = FillApiModelService::FillProfileResultModel(user());
            }
        } else {
            throw new \yii\web\HttpException(200, "User not found", 200);
        }
        return $data;
    }

}