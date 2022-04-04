<?php

namespace app\models;

use Yii;
use yii\base\Model;

class Signup extends Model{
    public $login;
    public $password;

    public function rules(){
        return [
            [['login', 'password'], 'required'],
            [['login'], 'unique', 'targetClass'=>'app\models\User'],
            [['password'], 'string', 'min'=>2, 'max'=>10]
        ];
    }

    public function attributeLabels(){
        return [
            'login' => 'Логин',
            'password' => 'Пароль',
        ];
    }

    public function signup() : bool{
        $user = new User();
        $user->login=$this->login;
        $user->setPassword($this->password);
        $saved = $user->save();
        $user->setRole();
        return $saved;
    }
}