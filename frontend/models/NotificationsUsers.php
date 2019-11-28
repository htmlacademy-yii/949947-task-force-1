<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notifications_users".
 *
 * @property int $id
 * @property int $user_id
 * @property string $messages
 */
class NotificationsUsers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notifications_users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'messages'], 'required'],
            [['user_id'], 'integer'],
            [['messages'], 'string'],
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
            'messages' => 'Messages',
        ];
    }
}
