<?php

namespace frontend\models;

use Yii;
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
            [['user_id', 'task_id', 'description', 'dt_add_replies'], 'required'],
            [['user_id', 'task_id'], 'integer'],
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
            'dt_add_replies' => 'Dt Add Replies',
        ];
    }

    /**
     * связь с таблицей Users
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }

    /**
     * связь с таблицей taskInfo
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaskInfo()
    {
        return $this->hasOne(TaskInfo::class, ['id' => 'task_id']);
    }

    /**
     *  Возвращает отклики на текущее задание
     *
     * @param $id
     * @return array|ActiveRecord[]
     */
    public static function getReplies($id): array
    {
        return Replies::find()->joinWith(Users::tableName())->joinWith(TaskInfo::tableName())->where(['TaskInfo.id' => $id])->all();
    }
}
