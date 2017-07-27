<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "area".
 *
 * @property integer $id
 * @property string $name
 * @property integer $state_id
 *
 * @property State $state
 * @property Rooms[] $rooms
 */
class Area extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'area';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'state_id'], 'required'],
            [['state_id'], 'integer'],
            [['name'], 'string', 'max' => 20],
            [['state_id'], 'exist', 'skipOnError' => true, 'targetClass' => State::className(), 'targetAttribute' => ['state_id' => 'id']],
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
            'state_id' => 'State ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getState()
    {
        return $this->hasOne(State::className(), ['id' => 'state_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRooms()
    {
        return $this->hasMany(Rooms::className(), ['area' => 'id']);
    }
         public static function getArea($state_id) {
        $data=\backend\models\Area::find()
       ->where(['state_id'=>$state_id])
       ->select(['id','name'])->asArray()->all();

            return $data;
        }
}
