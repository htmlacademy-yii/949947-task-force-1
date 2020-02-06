<?php

namespace frontend\models;

use frontend\helpers\DateHelper;
use phpDocumentor\Reflection\Types\Object_;
use Yii;
use yii\db\ActiveRecord;
use yii\db\ActiveQuery;
use yii\db\Query;

/**
 * This is the model class for table "task_info".
 *
 * @property int $id
 * @property string $name
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
        return 'taskInfo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'category_id', 'description', 'customer_id', 'dt_add', 'latitude', 'longitude'], 'required'],
            [['category_id', 'budget', 'executor_id', 'customer_id'], 'integer'],
            [['expire', 'dt_add'], 'safe'],
            [['name', 'description', 'address', 'latitude', 'longitude'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
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

    /**
     * Связь с таблицой категорий
     *
     * @return ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasOne(Categories::class, ['id' => 'category_id']);
    }

    /**
     * Связь с таблицой пользователей
     *
     * @return ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasOne(Users::class, ['id' => 'customer_id']);
    }

    /**
     * Возвращает информацию о задание
     *
     * @param $id
     * @return array|ActiveRecord|null
     */
    public static function getTaskInfo($id): ActiveRecord
    {
        return TaskInfo::find()->With(Categories::tableName())->where(['id' => (int)$id])->one();
    }

    /**
     * Возвращает данные заказчика
     *
     * @param $id
     * @return array|ActiveRecord|null
     */
    public static function getCostumer($id): ActiveRecord
    {
        return TaskInfo::find()->with(Users::tableName())->where(['id' => (int)$id])->one();
    }
}
