<?php

use yii\db\Migration;

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
        $this->createTable('driver', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('driver');
    }
}
