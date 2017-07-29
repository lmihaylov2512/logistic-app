<?php

namespace app\helpers;

use \DateTime;
use yii\db\Migration;

/**
 * @since 1.0
 * @author Lachezar Mihaylov <contact@lmihaylov.com>
 */
class DatabaseHelper extends BaseHelper
{
    const FORMAT_DATE = 'Y-m-d';
    const FORMAT_DATE_TIME = 'Y-m-d H:i:s';
    const BOOLEAN_TRUE = 1;
    const BOOLEAN_FALSE = 0;
    const DEFAULT_ZERO = 0;
    
    public static function getTableOptions(Migration $migration)
    {
        if ($migration->db->driverName === 'mysql') {
            return 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
    }
    
    public static function convertDate($date)
    {
        if (!empty($date) && strtotime($date)) {
            $date = new DateTime($date);
            
            return $date->format(self::FORMAT_DATE);
        }
    }
}
