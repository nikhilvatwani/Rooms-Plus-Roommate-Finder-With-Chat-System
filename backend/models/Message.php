<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "message".
 *
 * @property integer $id
 * @property integer $c_id
 * @property integer $p_id
 * @property integer $chat_id
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c_id', 'p_id', 'chat_id'], 'required'],
            [['c_id', 'p_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'c_id' => 'C ID',
            'p_id' => 'P ID',
            'chat_id' => 'Chat ID',
        ];
    }
}
