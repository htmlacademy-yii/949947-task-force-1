<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

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
            [['latitude', 'longitude', 'name_city'], 'required'],
            [['latitude', 'longitude', 'name_city'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'name_city' => 'Name City',
        ];
    }

    /**
     * Возвращает список возможных городов
     *
     * @return array
     */
    public static function getCities(): array
    {
        $cities = self::find()->select(['id','name_city'])->all();

        if (!$cities) {
            return [];
        }

        return ArrayHelper::map($cities,'id','name_city');

    }
}
