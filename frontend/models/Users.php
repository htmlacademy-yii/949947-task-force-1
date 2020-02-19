<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $name
 * @property int|null $rating
 * @property string|null $biography
 * @property string|null $avatar
 * @property string $latitude
 * @property string $longitude
 * @property string $dt_add
 */
class Users extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
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
            [['rating'], 'integer'],
            [['biography'], 'string'],
            [['dt_add_user'], 'safe'],
            [['email', 'name_user', 'avatar'], 'string', 'max' => 255],
            ['password', 'string', 'min' => 8, 'message' => 'Пароль должен быть больше 8 символов'],
            ['email', 'email', 'message' => 'Введите валидный адрес электронной почты'],
            ['email', 'unique', 'message' => 'Такой адрес электронной почты уже зарегестрирован'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'password' => 'Password',
            'name_user' => 'Name User',
            'rating' => 'Rating',
            'biography' => 'Biography',
            'avatar' => 'Avatar',
            'dt_add_user' => 'Dt Add User',
            'name_city' => 'Name City'
        ];
    }
}
