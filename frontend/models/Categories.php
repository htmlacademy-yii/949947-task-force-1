<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "categories".
 *
 * @property int $id
 * @property string $name_category
 * @property string $en_name
 */
class Categories extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_category', 'en_name'], 'required'],
            [['name_category', 'en_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_category' => 'Name Category',
            'en_name' => 'En Name',
        ];
    }

    /**
     * Возвращает список возможных категорий
     *
     * @return array|false
     */
    public static function getCategoriesList(): array
    {
        $categories = self::find()->all();

        return $categories ? ArrayHelper::map($categories, 'id', 'name_category') : [];
    }
}
