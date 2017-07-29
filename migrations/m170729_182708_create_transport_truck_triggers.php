<?php

use yii\db\Migration;

class m170729_182708_create_transport_truck_triggers extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->execute(
<<<'AI'
CREATE TRIGGER `transport_truck_AI` AFTER INSERT ON `transport_truck` FOR EACH ROW
BEGIN
    UPDATE `truck` SET `status` = 2 WHERE `id` = NEW.`truck_id`;
END
AI
        );
        
        $this->execute(
<<<'AD'
CREATE TRIGGER `transport_truck_AD` AFTER DELETE ON `transport_truck` FOR EACH ROW
BEGIN
    UPDATE `truck` SET `status` = 1 WHERE `id` = OLD.`truck_id`;
END
AD
        );
    }
    
    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->execute('DROP TRIGGER IF EXISTS `transport_truck_AI`');
        $this->execute('DROP TRIGGER IF EXISTS `transport_truck_AD`');
    }
}
