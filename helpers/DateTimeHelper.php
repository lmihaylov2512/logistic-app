<?php

namespace app\helpers;

/**
 * @since 1.0
 * @author Lachezar Mihaylov <contact@lmihaylov.com>
 */
class DateTimeHelper extends BaseHelper
{
    public static function calculateDatesDiff($start, $end = null)
    {
        $end = $end ?? date('Y-m-d');
        
        return date_diff(date_create($start), date_create($end))->d;
    }
}
