<?php

namespace app\helpers;

/**
 * @since 1.0
 * @author Lachezar Mihaylov <contact@lmihaylov.com>
 */
class TransportHelper extends BaseHelper
{
    const STATUS_NOT_STARTED = 0;
    const STATUS_TRANSPORTING = 1;
    const STATUS_COMPLETED = 2;
    
    public static function getStatusOptions()
    {
        return [
            self::STATUS_NOT_STARTED => 'Not started',
            self::STATUS_TRANSPORTING => 'Transporting',
            self::STATUS_COMPLETED => 'Completed',
        ];
    }
}
