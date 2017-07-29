<?php

namespace app\helpers;

use app\models\Truck;
use yii\helpers\ArrayHelper;

/**
 * @since 1.0
 * @author Lachezar Mihaylov <contact@lmihaylov.com>
 */
class TruckHelper extends BaseHelper
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_USED = 2;
    
    public static function getStatusOptions($all = false)
    {
        $options = [
            self::STATUS_INACTIVE => 'Inactive',
            self::STATUS_ACTIVE => 'Active',
        ];
        
        if ($all) {
            $options[self::STATUS_USED] = 'Used';
        }
        
        return $options;
    }
    
    public static function getAvailableTrucks($asArray = false)
    {
        return Truck::find()->where(['status' => self::STATUS_ACTIVE])->asArray($asArray)->all();
    }
    
    public static function getAvailableTrucksOptions()
    {
        return ArrayHelper::map(static::getAvailableTrucks(true), 'id', 'registration_number');
    }
    
    public static function getUsedTrucks($asArray = false)
    {
        return Truck::find()->where(['status' => self::STATUS_USED])->asArray($asArray)->all();
    }
}
