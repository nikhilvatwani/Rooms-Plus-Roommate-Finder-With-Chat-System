<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "rooms".
 *
 * @property integer $id
 * @property integer $type
 * @property integer $no_of_rooms
 * @property integer $rent
 * @property integer $flat_no
 * @property string $building_name
 * @property integer $country
 * @property integer $state
 * @property integer $area
 * @property string $description
 * @property integer $images
 * @property string $interested
 * @property string $created_at
 *
 * @property Interested[] $interesteds
 * @property Partner[] $partners
 * @property Country $country0
 * @property State $state0
 * @property Area $area0
 */
class Rooms extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public static function tableName()
    {
        return 'rooms';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'no_of_rooms', 'rent', 'flat_no', 'building_name', 'country', 'state', 'area', 'description'], 'required'],
            [['type', 'no_of_rooms', 'rent', 'flat_no', 'country', 'state', 'area'], 'integer'],
            [['created_at','images'], 'safe'],
            [['building_name'], 'string', 'max' => 20],
            [['interested'], 'string', 'max' => 30],
            [['country'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country' => 'id']],
            [['state'], 'exist', 'skipOnError' => true, 'targetClass' => State::className(), 'targetAttribute' => ['state' => 'id']],
            [['area'], 'exist', 'skipOnError' => true, 'targetClass' => Area::className(), 'targetAttribute' => ['area' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'no_of_rooms' => 'No Of Rooms',
            'rent' => 'Rent',
            'flat_no' => 'Flat No',
            'building_name' => 'Building Name',
            'country' => 'Country',
            'state' => 'State',
            'area' => 'Area',
            'description' => 'Description',
            'interested' => 'Interested',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInteresteds()
    {
        return $this->hasMany(Interested::className(), ['room_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartners()
    {
        return $this->hasMany(Partner::className(), ['room_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry0()
    {
        return $this->hasOne(Country::className(), ['id' => 'country']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getState0()
    {
        return $this->hasOne(State::className(), ['id' => 'state']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArea0()
    {
        return $this->hasOne(Area::className(), ['id' => 'area']);
    }
    public function upload()
    {

        foreach ($this->images_file as $file) {
                $file->saveAs('../uploads/' . $file->baseName . '.' . $file->extension);
            }
            return true;
    }
}
