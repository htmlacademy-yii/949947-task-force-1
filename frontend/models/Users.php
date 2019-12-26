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
    public function rules()
    {
        return [
            [['email', 'password', 'name', 'latitude', 'longitude', 'dt_add'], 'required'],
            [['rating'], 'integer'],
            [['biography'], 'string'],
            [['dt_add'], 'safe'],
            [['email', 'name', 'avatar', 'latitude', 'longitude'], 'string', 'max' => 255],
            [['password'], 'string', 'max' => 64],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'password' => 'Password',
            'name' => 'Name',
            'rating' => 'Rating',
            'biography' => 'Biography',
            'avatar' => 'Avatar',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'dt_add' => 'Dt Add',
        ];
    }
}
