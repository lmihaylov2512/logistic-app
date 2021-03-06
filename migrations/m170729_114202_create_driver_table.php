<?php

use yii\db\Migration;
use app\helpers\DatabaseHelper;

/**
 * Handles the creation of table `driver`.
 */
class m170729_114202_create_driver_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        // create a table "driver"
        $this->createTable('driver', [
            'id' => $this->primaryKey()->unsigned()->notNull(),
            'first_name' => $this->string(64)->notNull(),
            'last_name' => $this->string(64)->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ], DatabaseHelper::getTableOptions($this));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('driver');
    }
}
