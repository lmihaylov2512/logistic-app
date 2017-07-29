<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use app\helpers\{DatabaseHelper, TransportHelper, DateTimeHelper};

/**
 * This is the model class for table "transport".
 *
 * @property string $id
 * @property string $freight_id
 * @property integer $status
 * @property string $start_at
 * @property integer $duration
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Freight $freight
 * @property TransportTruck $transportTruck
 * @property Truck $truck
 */
class Transport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transport';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['freight_id', 'start_at', 'duration'], 'required'],
            [['freight_id', 'status', 'duration'], 'integer'],
            [['start_at', 'created_at', 'updated_at'], 'safe'],
            [['freight_id'], 'exist', 'skipOnError' => true, 'targetClass' => Freight::className(), 'targetAttribute' => ['freight_id' => 'id']],
            [['start_at'], 'filter', 'filter' => function ($value) { return DatabaseHelper::convertDate($value); }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'freight_id' => 'Freight',
            'status' => 'Status',
            'start_at' => 'Start At',
            'duration' => 'Duration',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFreight()
    {
        return $this->hasOne(Freight::className(), ['id' => 'freight_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransportTruck()
    {
        return $this->hasOne(TransportTruck::className(), ['transport_id' => 'id']);
    }
    
    public function getTruck()
    {
        return $this->hasOne(Truck::className(), ['id' => 'truck_id'])->viaTable('transport_truck', ['transport_id' => 'id']);
    }
    
    public function start()
    {
        if ($this->status == TransportHelper::STATUS_NOT_STARTED && $this->transportTruck !== null) {
            $this->status = TransportHelper::STATUS_TRANSPORTING;
            $this->start_at = new Expression('NOW()');
            
            return $this->save(false);
        }
        
        return false;
    }
    
    public function complete()
    {
        if ($this->status == TransportHelper::STATUS_TRANSPORTING) {
            $this->status = TransportHelper::STATUS_COMPLETED;
            $this->duration = DateTimeHelper::calculateDatesDiff($this->start_at);
            
            return $this->save(false);
        }
        
        return false;
    }
}
