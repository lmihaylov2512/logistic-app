<?php

use yii\db\Migration;

class m170729_183420_create_transport_trigger extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->execute(
<<<'AU'
CREATE TRIGGER `transport_AU` AFTER UPDATE ON `transport` FOR EACH ROW
transport_AU:BEGIN
    DECLARE truck_status INT UNSIGNED;
    
    IF OLD.`status` = NEW.`status` THEN
        LEAVE transport_AU;
    END IF;
    
    CASE NEW.`status`
        WHEN 1 THEN SET truck_status = 2;
        WHEN 2 THEN SET truck_status = 1;
    END CASE;
    
    UPDATE `truck` SET `status` = truck_status WHERE `id` = (SELECT `truck_id` FROM `transport_truck` WHERE `transport_id` = NEW.`id`);
END
AU
        );
    }
    
    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->execute('DROP TRIGGER IF EXISTS `transport_AU`');
    }
}
