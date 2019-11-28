<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "last_action_time".
 *
 * @property int $id
 * @property int $task_id
 * @property string $last_action_time
 */
class LastActionTime extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'last_action_time';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'last_action_time'], 'required'],
            [['task_id'], 'integer'],
            [['last_action_time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'task_id' => 'Task ID',
            'last_action_time' => 'Last Action Time',
        ];
    }
}
