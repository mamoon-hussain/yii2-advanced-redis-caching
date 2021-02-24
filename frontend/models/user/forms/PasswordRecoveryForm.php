<?php

namespace frontend\models\user\forms;

use common\enums\UserConfirmationType;
use common\models\User;
use common\models\UserMobileEmail;
use common\services\UserService;
use Yii;

class PasswordRecoveryForm extends \webvimark\modules\UserManagement\models\forms\PasswordRecoveryForm {



    public function attributeLabels()
    {
        $p = parent::attributeLabels();
        $p['birth_date'] = t('Birth Date');
        $p['username'] = t('Username');
        $p['phone'] = t('Phone');
        $p['repeat_password'] = t('Repeat password');
        return $p;
    }

    public function sendCodePhone()
    {
        $user = User::find();
        $user = $user->andWhere(['phone' => $this->phone]);

//        $user = $user->andWhere(['status' => User::STATUS_ACTIVE])
//            ->one();
        $user = $user->one();
        if(!$user){
            throw new \yii\web\HttpException(200, "User not found", 200);
        }

        $model = UserMobileEmail::find();
        $model = $model->andWhere(['mobile' => $this->phone])
            ->andWhere(['type' => UserConfirmationType::forgot_password]);
        $model = $model->andWhere(['is_confirmed' => 0])
            ->one();


        if(!$model){
            $model = new UserMobileEmail([
                'confirm_code' => rand(10000, 99999),
                'is_confirmed' => 0,
                'is_primary' => 0,
                'user_id' => $user->id,
            ]);

            $model->mobile = $this->phone;
            $model->type = UserConfirmationType::forgot_password;
//            stopv($model);
            if (!$model->save()) {
//                stopv($model->errors);
                throw new \yii\web\HttpException(200, "Forget password model not saved", 200);
            }
        }

        //send code
        $msg = UserService::Msg_RegistrationSuccessForgetPasswordPhone;
//            UserService::sendCodePhone($model);
//        $model->sendConfirmationCodePhone(UserConfirmationType::forgot_password);

        $model->sendConfirmationCodePhone(UserConfirmationType::forgot_password);
        return true;
    }

}
