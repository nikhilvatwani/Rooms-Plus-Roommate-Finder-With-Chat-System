<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "credintials".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property integer $role
 */
class Credintials extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'credintials';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['role'], 'integer'],
            [['username'], 'string', 'max' => 40],
            [['password'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'role' => 'Role',
        ];
    }
}
