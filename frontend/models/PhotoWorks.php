<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "photo_works".
 *
 * @property int $id
 * @property string $path
 * @property int $task_id
 */
class PhotoWorks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'photo_works';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['path', 'task_id'], 'required'],
            [['task_id'], 'integer'],
            [['path'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'path' => 'Path',
            'task_id' => 'Task ID',
        ];
    }
}
