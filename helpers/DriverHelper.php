<?php

namespace app\helpers;

use yii\caching\DbDependency;
use yii\helpers\ArrayHelper;
use app\models\Driver;

/**
 * @since 1.0
 * @author Lachezar Mihaylov <contact@lmihaylov.com>
 */
class DriverHelper extends BaseHelper
{
    public static function getDriversOptions()
    {
        return ArrayHelper::map(static::pullDriversData(), 'id', 'fullName');
    }
    
    protected static function pullDriversData()
    {
        return Driver::getDb()->cache(function () {
            return Driver::find()->all();
        }, self::TTL_FOREVER, new DbDependency(['sql' => 'SELECT MAX(`updated_at`) FROM ' . Driver::getTableSchema()->name]));
    }
}
