<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "contacts".
 *
 * @property int $id
 * @property int $user_id
 * @property string $messager_name
 * @property string $message_contacts
 */
class Contacts extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contacts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'messager_name', 'message_contacts'], 'required'],
            [['user_id'], 'integer'],
            [['messager_name', 'message_contacts'], 'string', 'max' => 255],
            [['user_id'], 'unique'],
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
            'messager_name' => 'Messager Name',
            'message_contacts' => 'Message Contacts',
        ];
    }
}
