<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $contact_no
 * @property integer $occupation
 * @property integer $age
 * @property integer $gender
 * @property string $interested
 *
 * @property Interested[] $interesteds
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $password;
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'contact_no', 'occupation', 'age', 'gender','password'], 'required'],
            [['contact_no', 'occupation', 'age', 'gender'], 'integer'],
            [['name'], 'string', 'max' => 20],
            [['email', 'interested'], 'string', 'max' => 30],
            ['email','email'],
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
            'contact_no' => 'Contact No',
            'occupation' => 'Occupation',
            'age' => 'Age',
            'gender' => 'Gender',
            'interested' => 'Interested',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInteresteds()
    {
        return $this->hasMany(Interested::className(), ['c_id' => 'id']);
    }
}
