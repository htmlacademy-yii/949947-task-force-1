<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "replies".
 *
 * @property int $id
 * @property int $user_id
 * @property int $task_id
 * @property string $description
 * @property string $dt_add
 * @property int|null $rate
 * @property Users $user
 * @property TaskInfo $taskInfo
 */
class Replies extends ActiveRecord
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

    /**
     * связь с таблицей Users
     *
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }

    /**
     * связь с таблицей taskInfo
     *
     * @return ActiveQuery
     */
    public function getTaskInfo()
    {
        return $this->hasOne(TaskInfo::class, ['id' => 'task_id']);
    }

    /**
     * Возвращает отклики на текущее задание
     *
     * @param $id
     * @return array|ActiveRecord[]
     */
    public static function getReplies($id): array
    {
        return self::find()->joinWith('user')->joinWith('taskInfo')->where(['TaskInfo.id' => $id])->all();
    }
}
