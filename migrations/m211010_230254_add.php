<?php

use yii\db\Migration;

/**
 * Class m211010_230254_add
 */
class m211010_230254_add extends Migration
{
   private $tableName = 'game';

    public function safeUp(): bool
    {
        $this->addColumn($this->tableName, 'blue_team_name', $this->string(255));
        $this->addColumn($this->tableName, 'red_team_name', $this->string(255));
        return true;
    }


    public function safeDown(): bool
    {
       $this->dropColumn($this->tableName, 'blue_team_name');
        $this->dropColumn($this->tableName, 'red_team_name');

        return false;
    }
}
