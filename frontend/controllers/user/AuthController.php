<?php

namespace frontend\controllers\user;

use backend\models\user\forms\ConfirmationForm;
use backend\models\user\forms\VRegistrationForm;
use common\enums\UserConfirmationType;
use common\models\UserMobileEmail;
use common\services\EmailService;
use frontend\models\user\forms\ChangeOwnPasswordForm;
use frontend\models\user\forms\PasswordRecoveryForm;
use webvimark\modules\UserManagement\models\forms\ConfirmMobileForm;
use Cassandra\Type\UserType;
use common\enums\Constents;
use common\models\User;
use common\models\Admin;
use common\services\UserService;
use frontend\models\RegistrationForm;
use webvimark\modules\UserManagement\components\UserAuthEvent;
use webvimark\modules\UserManagement\libs\LibAdmin;
use webvimark\modules\UserManagement\models\forms\AdminLoginForm;
use webvimark\modules\UserManagement\models\forms\LoginForm;
use Yii;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

class AuthController extends \webvimark\modules\UserManagement\controllers\AuthController {


    public function actionLogin() {
        $this->layout = '//main';

        $post = Yii::$app->request->post();
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $base = Url::base();

        if (strpos($base, 'admin') !== false) {
            $model = new AdminLoginForm();
        } else {
            $model = new LoginForm();
        }

        if (Yii::$app->request->isAjax AND $model->load($post)) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

//        stopv($model->login() );

        if ($model->load($post) AND $model->login()) {
            return $this->goBack();
        }

        if (strpos($base, 'admin') !== false) {
            return $this->renderIsAjax('admin_login', compact('model'));
        } else {

            return $this->renderIsAjax('login', [
                'model' => $model,
            ]);
        }
    }



    public function actionRegistration(){

        $this->layout = '//main';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $post = Yii::$app->request->post();

        $model = new RegistrationForm();

        if ($model->load($post) && $model->validate()) {
//            stopv('ll');
            list($result, $user, $msg) = UserService::profileCreate($model->attributes);

            if ($result) {
//                stopv('zz');
                Yii::$app->session->setFlash('flash_success', t('we sent you confirmation code. Please check your sms to verify your account'));
                return $this->redirect(['confirm-phone', 'p' => $model->phone]);
//                return $this->renderIsAjax('registrationWaitForPhoneConfirmation', compact('user'));
            }
            if(!$model->save()){
                return $model->errors;
            }

            //send email
            $emailCompose = Yii::$app->mailer->compose('/email/new_register', ['model' => $user]);
            $email_title = 'New Registration';
            $email_sent = EmailService::sendNotificationEmail($emailCompose, $email_title);
            //

            foreach ($user->errors as $error) {
                $model->addError('username', $error);
            }
        }
        return $this->renderIsAjax('registration', compact('model'));
    }

    public function actionPasswordRecovery() {
        $this->layout = '//main';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new PasswordRecoveryForm();

        $post = Yii::$app->request->post();

        if ($model->load(Yii::$app->request->post()) AND $model->validate()) {
            if ($this->triggerModuleEvent(UserAuthEvent::BEFORE_PASSWORD_RECOVERY_REQUEST, ['model' => $model])) {
//                if ($model->sendEmail(false)) {
                if ($model->sendCodePhone()) {

                    return $this->redirect('password-recovery-code');
//                    if ($this->triggerModuleEvent(UserAuthEvent::AFTER_PASSWORD_RECOVERY_REQUEST, ['model' => $model])) {
//                        return $this->renderIsAjax('passwordRecoverySuccess');
//                    }
                } else {
                    Yii::$app->session->setFlash('error', t('all', "Unable to send message for phone provided"));
                }
            }
        }

        return $this->renderIsAjax('passwordRecovery',[
            'model' => $model,
        ]);
    }

    public function actionPasswordRecoveryCode() {
        $this->layout = '//main';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new ChangeOwnPasswordForm([
            'scenario' => 'restoreViaPhone',
        ]);

        $post = Yii::$app->request->post();
        if ($model->load($post)) {
            $model->phone = $post['ChangeOwnPasswordForm']['phone'];
            $model->code = $post['ChangeOwnPasswordForm']['code'];
            $model->password = $post['ChangeOwnPasswordForm']['password'];
            $model->repeat_password = $post['ChangeOwnPasswordForm']['repeat_password'];
            $userMobileEmail = UserMobileEmail::find()
                ->andWhere(['mobile' => $model->phone])
                ->andWhere(['type' => UserConfirmationType::forgot_password])
                ->andWhere(['is_confirmed' => 0])
                ->andWhere(['confirm_code' => $model->code])
                ->one();

            if(!$userMobileEmail){
                $model->addError('phone', t('Phone or Code are not correct'));
                return $this->renderIsAjax('changeOwnPassword', compact('model'));
            }

            $user = User::findOne($userMobileEmail->user_id);
            $model->user = $user;

            if ($this->triggerModuleEvent(UserAuthEvent::BEFORE_PASSWORD_RECOVERY_COMPLETE, ['model' => $model])) {
                $model->changePassword(false);

                if ($this->triggerModuleEvent(UserAuthEvent::AFTER_PASSWORD_RECOVERY_COMPLETE, ['model' => $model])) {
                    return $this->renderIsAjax('changeOwnPasswordSuccess');
                }
            }
        }

        return $this->renderIsAjax('changeOwnPassword', [
            'model' => $model,
        ]);
    }

    public function actionConfirmPhone($p = '') {
        $this->layout = '//main';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new ConfirmMobileForm();
        $model->mobile = $p;
        $post = Yii::$app->request->post();
        if ($model->load($post) AND $model->validate()) {
            $user = $model->save();
            if($user){
                Yii::$app->user->login($user);
                return $this->redirect(Yii::$app->homeUrl);
            } else {
                Yii::$app->session->setFlash('flash_error', t("User or code not found"));
            }
        }

        return $this->renderIsAjax('phoneConfirm',[
            'model' => $model,
        ]);
    }


//    public function actionRegistration() {
//        //stopv('bbb');
//        $this->layout = 'loginLayout';
//        if (!Yii::$app->user->isGuest) {
//            return $this->goHome();
//        }
//
//        $model = new \webvimark\modules\UserManagement\models\forms\LoginForm();
//
//        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
//            Yii::$app->response->format = Response::FORMAT_JSON;
//            // Ajax validation breaks captcha. See https://github.com/yiisoft/yii2/issues/6115
//            // Thanks to TomskDiver
//            $validateAttributes = $model->attributes;
//            unset($validateAttributes['captcha']);
//
//            return ActiveForm::validate($model, $validateAttributes);
//        }
//
//        $post = Yii::$app->request->post();
//        stopv($post);
//        if ($model->load(Yii::$app->request->post()) && $model->validate() && $this->triggerModuleEvent(UserAuthEvent::BEFORE_REGISTRATION, ['model' => $model])) {
//            $post = $model->attributes;
//            $user = new User([
//                'username' => $post['username'],
//                'password' => $post['password'],
//                'email' => $post['email'],
//                'created_at' => time(),
//                'updated_at' => time(),
//                'type' => UserType::training_center,
//            ]);
//            $user->password_hash = self::setPassword($post["password"]);
//            $user->status = User::STATUS_INACTIVE;
//            $user->generateConfirmationToken();
//            $t = Yii::$app->db->beginTransaction();
//            $result = $user->save();
//            if (!$result) {
////            stopv($model->errors);
//                $t->rollBack();
//            } else {
//                $t->commit();
//                foreach (Role::find()->all() as $role) {
//                    User::assignRole($user->id, $role->name);
//                }
//            }
//            $result ? t(LibUser::Msg_RegistrationSuccess) . (isset($msg) ? $msg : "") : "";
//
//            if ($result && $this->triggerModuleEvent(UserAuthEvent::AFTER_REGISTRATION, ['model' => $model, 'user' => $user])) {
//                if ($model->sendConfirmationEmail($user)) {
//                    $text = '';
//                    return $this->renderIsAjax('registrationWaitForEmailConfirmation', compact('user', 'text'));
//                } else {
//                    Yii::$app->session->setFlash('error', UserManagementModule::t('front', "Unable to send message for email provided"));
//                }
//            }
//
//            foreach ($user->errors as $error) {
//                $model->addError('username', $error);
//            }
//
//        }
//        return $this->renderIsAjax('registration', compact('model'));
//    }


}
