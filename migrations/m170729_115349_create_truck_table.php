<?php

use yii\db\Migration;
use app\helpers\DatabaseHelper;

/**
 * Handles the creation of table `truck`.
 */
class m170729_115349_create_truck_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        // create a table "truck"
        $this->createTable('truck', [
            'id' => $this->primaryKey()->unsigned()->notNull(),
            'driver_id' => $this->integer()->unsigned()->notNull(),
            'status' => $this->smallInteger()->unsigned()->notNull()->defaultValue(DatabaseHelper::DEFAULT_ZERO)->comment('0-Inactive; 1-Active; 2-Used'),
            'registration_number' => $this->string(32)->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ], DatabaseHelper::getTableOptions($this));
        
        $this->addForeignKey('fk_truck_driver_id', 'truck', 'driver_id', 'driver', 'id', 'RESTRICT', 'CASCADE');
        $this->createIndex('idx_truck_registration_number', 'truck', 'registration_number', true);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('truck');
    }
}
