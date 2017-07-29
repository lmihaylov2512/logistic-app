<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "driver".
 *
 * @property string $id
 * @property string $first_name
 * @property string $last_name
 * @property string $created_at
 * @property string $updated_at
 * 
 * @property string $fullName
 * 
 * @property Truck[] $trucks
 */
class Driver extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'driver';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['first_name', 'last_name'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrucks()
    {
        return $this->hasMany(Truck::className(), ['driver_id' => 'id']);
    }
    
    public function getFullName()
    {
        return implode(' ', [$this->first_name, $this->last_name]);
    }
}
