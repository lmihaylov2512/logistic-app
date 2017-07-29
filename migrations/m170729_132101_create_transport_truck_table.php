<?php

use yii\db\Migration;
use app\helpers\DatabaseHelper;

/**
 * Handles the creation of table `transport_truck`.
 */
class m170729_132101_create_transport_truck_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        // create a table "transport_truck"
        $this->createTable('transport_truck', [
            'transport_id' => $this->primaryKey()->unsigned()->notNull(),
            'truck_id' => $this->integer()->unsigned()->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ], DatabaseHelper::getTableOptions($this));
        
        $this->addForeignKey('fk_transport_truck_transport_id', 'transport_truck', 'transport_id', 'transport', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_transport_truck_truck_id', 'transport_truck', 'truck_id', 'truck', 'id', 'RESTRICT', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('transport_truck');
    }
}
