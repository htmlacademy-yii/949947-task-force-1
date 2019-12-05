<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "replies".
 *
 * @property int $id
 * @property int $user_id
 * @property int $task_id
 * @property string $description
 * @property string $dt_add
 * @property int|null $rate
 */
class Replies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'replies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'task_id', 'description', 'dt_add'], 'required'],
            [['user_id', 'task_id', 'rate'], 'integer'],
            [['dt_add'], 'safe'],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'task_id' => 'Task ID',
            'description' => 'Description',
            'dt_add' => 'Dt Add',
            'rate' => 'Rate',
        ];
    }
}
