<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "task_info".
 *
 * @property int $id
 * @property int $category_id
 * @property int|null $budget
 * @property string|null $expire
 * @property string $description
 * @property int|null $executor_id
 * @property int $customer_id
 * @property string $dt_add
 * @property string|null $address
 * @property string $latitude
 * @property string $longitude
 */
class TaskInfo extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'description', 'customer_id', 'dt_add', 'latitude', 'longitude'], 'required'],
            [['category_id', 'budget', 'executor_id', 'customer_id'], 'integer'],
            [['expire', 'dt_add'], 'safe'],
            [['description', 'address', 'latitude', 'longitude'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'budget' => 'Budget',
            'expire' => 'Expire',
            'description' => 'Description',
            'executor_id' => 'Executor ID',
            'customer_id' => 'Customer ID',
            'dt_add' => 'Dt Add',
            'address' => 'Address',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
        ];
    }
}
