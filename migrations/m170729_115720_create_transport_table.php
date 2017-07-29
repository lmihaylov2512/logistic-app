<?php

use yii\db\Migration;
use app\helpers\DatabaseHelper;

/**
 * Handles the creation of table `transport`.
 */
class m170729_115720_create_transport_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        // create a table "transport"
        $this->createTable('transport', [
            'id' => $this->primaryKey()->unsigned()->notNull(),
            'freight_id' => $this->integer()->unsigned()->notNull(),
            'status' => $this->smallInteger()->unsigned()->notNull()->defaultValue(DatabaseHelper::DEFAULT_ZERO)->comment('0-Not started; 1-Transporting; 2-Completed'),
            'start_at' => $this->date()->notNull(),
            'duration' => $this->smallInteger()->unsigned()->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ], DatabaseHelper::getTableOptions($this));
        
        $this->addForeignKey('fk_transport_freight_id', 'transport', 'freight_id', 'freight', 'id', 'RESTRICT', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('transport');
    }
}
