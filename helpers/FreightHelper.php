<?php

namespace app\helpers;

use yii\caching\DbDependency;
use yii\helpers\ArrayHelper;
use app\models\Freight;

/**
 * @since 1.0
 * @author Lachezar Mihaylov <contact@lmihaylov.com>
 */
class FreightHelper extends BaseHelper
{
    public static function getFreightsOptions()
    {
        return ArrayHelper::map(static::pullFreightsData(), 'id', 'name');
    }
    
    protected static function pullFreightsData()
    {
        return Freight::getDb()->cache(function () {
            return Freight::find()->all();
        }, self::TTL_FOREVER, new DbDependency(['sql' => 'SELECT MAX(`updated_at`) FROM ' . Freight::getTableSchema()->name]));
    }
}
