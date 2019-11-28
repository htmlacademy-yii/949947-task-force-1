<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "chat".
 *
 * @property int $id
 * @property string $message
 * @property int $sender_id
 * @property int $recipient_id
 */
class Chat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['message', 'sender_id', 'recipient_id'], 'required'],
            [['message'], 'string'],
            [['sender_id', 'recipient_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'message' => 'Message',
            'sender_id' => 'Sender ID',
            'recipient_id' => 'Recipient ID',
        ];
    }
}
