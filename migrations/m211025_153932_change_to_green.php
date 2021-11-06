<?php

use yii\db\Migration;

/**
 * Class m211025_153932_change_to_green
 */
class m211025_153932_change_to_green extends Migration
{
    private $tableName = 'game';

    public function safeUp()
    {

        $this->renameColumn($this->tableName, 'red_cards', 'green_cards');
        $this->renameColumn($this->tableName, 'red_team_name', 'green_team_name');
    }

    public function safeDown()
    {
        echo "m211025_153932_change_to_green cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211025_153932_change_to_green cannot be reverted.\n";

        return false;
    }
    */
}
