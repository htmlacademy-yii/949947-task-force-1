<?php

namespace frontend\models;

use yii\base\Model;

/**
 * Класс формы авторизации пользователя
 *
 * Class LoginForm
 * @package frontend\models
 */
class LoginForm extends Model
{
    public $email;
    public $password;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['email', 'password'], 'safe'],
            [['email', 'password'], 'required', 'message' => 'Это поле должно быть заполненно'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'email' => 'Email',
            'password' => 'Password',
        ];
    }

    /**
     * функция валидация пароля
     *
     * @param $attribute
     * @param $params
     */
    public function validatePassword($attribute, $params)
    {
        $user = $this->getUser();
        if (!$user || !$user->validatePassword($this->password)) {
            $this->addError($attribute, 'Неправильный email или пароль');
        }
    }

    /**
     * проверка наличия пользователя с таким email в БД
     *
     * @return Users|null
     */
    public function getUser(): ?Users
    {
        return Users::findOne(['email' => $this->email]);
    }
}
