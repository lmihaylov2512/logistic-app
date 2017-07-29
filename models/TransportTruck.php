<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transport_truck".
 *
 * @property string $transport_id
 * @property string $truck_id
 * @property string $created_at
 *
 * @property Transport $transport
 * @property Truck $truck
 */
class TransportTruck extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transport_truck';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['truck_id'], 'required'],
            [['truck_id'], 'integer'],
            [['created_at'], 'safe'],
            [['transport_id'], 'exist', 'skipOnError' => true, 'targetClass' => Transport::className(), 'targetAttribute' => ['transport_id' => 'id']],
            [['truck_id'], 'exist', 'skipOnError' => true, 'targetClass' => Truck::className(), 'targetAttribute' => ['truck_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'transport_id' => 'Transport ID',
            'truck_id' => 'Truck ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransport()
    {
        return $this->hasOne(Transport::className(), ['id' => 'transport_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTruck()
    {
        return $this->hasOne(Truck::className(), ['id' => 'truck_id']);
    }
}
