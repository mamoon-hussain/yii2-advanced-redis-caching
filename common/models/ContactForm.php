<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class  ContactForm extends Model {

    public $name;
    public $email;
//    public $verifyCode;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            // name, email, subject and body are required
            [['email'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
//            ['verifyCode', 'captcha'],
            [['name'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
//            'verifyCode' => 'Verify Code',
            'name' => t('Name'),
            'email' => t('Email'),
        ];
    }

    public function sendEmail($email) {

        $this->name = $this->name.' <'.$this->email.'>';

        return Yii::$app->mailer->compose()
            ->setFrom([Yii::$app->params['adminEmail'] => $this->name])
            ->setTo($email)
//                        ->setReplyTo($this->email)
            ->send();
    }

}
