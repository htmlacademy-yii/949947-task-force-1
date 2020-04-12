<?php

namespace frontend\models;

use yii\base\Model;

/**
 * модель формы регистрации
 *
 * Class RegistrationForm
 * @package frontend\models
 */
class RegistrationForm extends Model
{

    public $email;
    public $password;
    public $name_user;
    public $name_city;

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['email', 'password', 'name_user', 'name_city'], 'safe'],
            [
                ['email', 'password', 'name_user', 'name_city'],
                'required',
                'message' => 'Это поле должно быть заполненно'
            ],
            ['password', 'string', 'min' => 8, 'message' => 'Пароль должен быть больше 8 символов'],
            ['email', 'email', 'message' => 'Введите валидный адрес электронной почты'],
            [
                'email',
                'unique',
                'targetClass' => 'frontend\models\Users',
                'message' => 'Такой адрес электронной почты уже зарегестрирован'
            ],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'email' => 'Email',
            'password' => 'Password',
            'name_user' => 'Name User',
            'name_city' => 'Name City'
        ];
    }
}
