<?php

namespace frontend\models\user\forms;

use Yii;

class RegistrationForm extends \webvimark\modules\UserManagement\models\forms\RegistrationForm {

    public $birth_date;

    public function rules() {
        $rules = [
//            ['captcha', 'captcha', 'captchaAction' => '/user/auth/captcha'],
//            [['username', 'password', 'repeat_password', 'captcha'], 'required'],
            [['password', 'repeat_password'], 'required'],
            [['username', 'password', 'repeat_password'], 'trim'],
//            ['username', 'unique',
//                'targetClass' => 'webvimark\modules\UserManagement\models\User',
//                'targetAttribute' => 'username',
//            ],
//            ['username', 'purgeXSS'],
            ['password', 'string', 'max' => 255],
            ['email', 'email'],
            ['email', 'unique',
                'targetClass' => 'webvimark\modules\UserManagement\models\User',
                'targetAttribute' => 'email',
            ],
            ['repeat_password', 'compare', 'compareAttribute' => 'password'],
        ];

        if (Yii::$app->getModule('user')->useEmailAsLogin) {
//            $rules[] = ['username', 'email'];
        }

        if (Yii::$app->getModule('user')->emailConfirmationRequired) {
            $rules[] = ['email', 'required'];
        }
        if (Yii::$app->getModule('user')->useMobileRegistration) {
//            $rules[] = [['phone'], 'required'];
        } else {
            $rules[] = ['username', 'string', 'max' => 50];

            $rules[] = ['username', 'match', 'pattern' => Yii::$app->getModule('user')->registrationRegexp];
            $rules[] = ['username', 'match', 'not' => true, 'pattern' => Yii::$app->getModule('user')->registrationBlackRegexp];
        }
        $rules[] = [['birth_date'], 'safe'] ;

        return $rules;
    }

    public function attributeLabels()
    {
        $p = parent::attributeLabels();
        $p['birth_date'] = t('Birth Date');
        $p['username'] = t('Username');
        $p['phone'] = t('Phone');
        $p['repeat_password'] = t('Repeat password');
        return $p;
    }

}
