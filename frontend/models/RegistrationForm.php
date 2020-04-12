<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\db\Exception;

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

    /**
     * Функция добавлеяет нового пользователя в БД
     *
     * @throws \yii\base\Exception
     */
    public function addUser()
    {
        $user = new Users();
        $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
        $user->attributes = $this->attributes;

        return $user->save();
    }
}
