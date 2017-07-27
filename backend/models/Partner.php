<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "partner".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $contact
 * @property integer $room_id
 *
 * @property Rooms $room
 */
class Partner extends \yii\db\ActiveRecord
{
    public $type;
    public $no_of_rooms;
    public $rent;
    public $flat_no;
    public $building_name;
    public $country;
    public $state;
    public $area;
    public $description;
    public $images;
    public $password;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'contact','password'], 'required'],
            [['contact', 'room_id'], 'integer'],
            [['name'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 30],
            ['email','email'],
            [['room_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rooms::className(), 'targetAttribute' => ['room_id' => 'id']],
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
            'contact' => 'Contact',
            'room_id' => 'Room ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Rooms::className(), ['id' => 'room_id']);
    }
}
