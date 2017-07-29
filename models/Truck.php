<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "truck".
 *
 * @property string $id
 * @property string $driver_id
 * @property integer $status
 * @property string $registration_number
 * @property string $created_at
 * @property string $updated_at
 *
 * @property TransportTruck[] $transportTrucks
 * @property Driver $driver
 */
class Truck extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'truck';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['driver_id', 'registration_number'], 'required'],
            [['driver_id', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['registration_number'], 'string', 'max' => 32],
            [['registration_number'], 'unique'],
            [['driver_id'], 'exist', 'skipOnError' => true, 'targetClass' => Driver::className(), 'targetAttribute' => ['driver_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'driver_id' => 'Driver',
            'status' => 'Status',
            'registration_number' => 'Registration Number',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransportTrucks()
    {
        return $this->hasMany(TransportTruck::className(), ['truck_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDriver()
    {
        return $this->hasOne(Driver::className(), ['id' => 'driver_id']);
    }
}
