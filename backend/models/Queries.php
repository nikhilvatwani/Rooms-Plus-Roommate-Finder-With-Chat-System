<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "queries".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $subject
 * @property string $message
 */
class Queries extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'queries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'subject', 'message'], 'required'],
            [['message'], 'string'],
            [['name', 'email'], 'string', 'max' => 30],
            [['subject'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'subject' => 'Subject',
            'message' => 'Message',
        ];
    }
}
