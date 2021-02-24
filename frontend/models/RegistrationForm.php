<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\models;

use common\models\User;
use Yii;

class RegistrationForm extends \webvimark\modules\UserManagement\models\forms\RegistrationForm {
    public $phone;
    public $email;
    public $address;
    public $city;
    public $state;
    public $fname;
//    public $role;
    public function rules() {
        $p = parent::rules();

        $p[] = [['username'], 'validateUsername'] ;
//        $p[] = [['email'], 'validateEmail'] ;
        $p[] = [['phone'], 'validatePhone'] ;
//        $p[] = [['role'], 'required'] ;
        $p[] = [['password'], 'string', 'min' => 8];
        $p[] = [['fname', 'lname'], 'safe'];
        return $p;
    }

    public function validateUsername($attribute){
        if(User::find()->where(['username'=>$this->phone])->count()){
            $this->addError($attribute, t("Username already in use"));
        }
    }
//    public function validateEmail($attribute){
//        if(User::find()->where(['email'=>$this->email])->count()){
//            $this->addError($attribute, t("Email Already in use"));
//        }
//    }

    public function validatePhone($attribute){
        if(User::find()->where(['phone'=>$this->phone])->count()){
            $this->addError($attribute, t("Phone Already in use"));
        }
    }

    public function attributeLabels() {
        return [
            'phone' => t('Phone'),
            'email' => t('E-mail'),
//            'role' => t('Role'),
            'username' => Yii::$app->getModule('user-management') ? 'E-mail' : t('Login Name'),//UserManagementModule::t('front', 'Login'),
            'password' => t('Password'),//UserManagementModule::t('front', 'Password'),
            'repeat_password' => t('Repeat password'),//UserManagementModule::t('front', 'Repeat password'),
            'captcha' => t('Captcha'),//UserManagementModule::t('front', 'Captcha'),
            'fname' => t('First Name'),//UserManagementModule::t('front', 'First Name'),
            'lname' => t('Last Name'),//UserManagementModule::t('front', 'Last Name'),
            'country' => t('Country'),
            'second_email' => t('Second Email'),
            'address' => t('Address'),
            'city' => t('City'),
            'state' => t('State'),
            'fax_num' => t('Fax #'),
        ];
    }
}
