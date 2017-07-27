<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "chat".
 *
 * @property integer $ChatId
 * @property string $ChatUserId
 * @property string $ChatText
 */
class Chat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ChatUserId', 'ChatText'], 'required'],
            [['ChatText'], 'string'],
            [['ChatUserId'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ChatId' => 'Chat ID',
            'ChatUserId' => 'Chat User ID',
            'ChatText' => 'Chat Text',
        ];
    }
}
