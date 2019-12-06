<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "cities".
 *
 * @property int $id
 * @property string $latitude
 * @property string $longitude
 */
class Cities extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cities';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['latitude', 'longitude'], 'required'],
            [['latitude', 'longitude'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
        ];
    }
}
