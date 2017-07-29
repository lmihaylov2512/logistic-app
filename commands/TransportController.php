<?php

namespace app\commands;

use yii\console\Controller;

/**
 * @since 1.0
 * @author Lachezar Mihaylov <contact@lmihaylov.com>
 */
class TransportController extends Controller
{
    public function actionStart()
    {
        echo "Starting transports \n";
        
        return self::EXIT_CODE_NORMAL;
    }
    
    public function actionComplete()
    {
        echo "Completing transports \n";
        
        return self::EXIT_CODE_NORMAL;
    }
}
