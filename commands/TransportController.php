<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use app\models\{Transport, TransportTruck};
use app\helpers\TransportHelper;

/**
 * @since 1.0
 * @author Lachezar Mihaylov <contact@lmihaylov.com>
 */
class TransportController extends Controller
{
    public function actionStart()
    {
        echo "Starting transports... \n";
        
        $rows = Yii::$app->db->createCommand(
                'UPDATE `' . Transport::getTableSchema()->name . '` t
                    INNER JOIN `' . TransportTruck::getTableSchema()->name . '` tt ON tt.transport_id = t.id
                SET t.`status` = ' . TransportHelper::STATUS_TRANSPORTING . '
                WHERE t.`status` = ' . TransportHelper::STATUS_NOT_STARTED . '
                    AND t.`start_at` < NOW()'
        )->execute();
        
        echo "Started transports: $rows \n";
        
        return self::EXIT_CODE_NORMAL;
    }
    
    public function actionComplete()
    {
        echo "Completing transports... \n";
        
        $rows = Yii::$app->db->createCommand(
                'UPDATE `' . Transport::getTableSchema()->name . '` t
                SET t.`status` = ' . TransportHelper::STATUS_COMPLETED . '
                WHERE t.`status` = ' . TransportHelper::STATUS_TRANSPORTING . '
                    AND DATE_ADD(t.`start_at`, INTERVAL t.`duration` DAY) < NOW()'
        )->execute();
        
        echo "Completed transports: $rows \n";
        
        return self::EXIT_CODE_NORMAL;
    }
}
