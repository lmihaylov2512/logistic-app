<?php

use yii\db\Migration;
use app\helpers\DatabaseHelper;

/**
 * Handles the creation of table `freight`.
 */
class m170729_115209_create_freight_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        // create a table "freight"
        $this->createTable('freight', [
            'id' => $this->primaryKey()->unsigned()->notNull(),
            'name' => $this->string(128)->notNull(),
            'weight' => $this->smallInteger()->unsigned()->null(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ], DatabaseHelper::getTableOptions($this));
        
        $this->createIndex('idx_freight_name', 'freight', 'name', true);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('freight');
    }
}
