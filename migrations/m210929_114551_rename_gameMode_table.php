<?php

use yii\db\Migration;

/**
 * Class m210929_114551_rename_gameMode_table
 */
class m210929_114551_rename_gameMode_table extends Migration
{
    private $oldTableName = 'gameMode';
    private $newTableName = 'game';

    public function safeUp()
    {
        $this->renameColumn($this->oldTableName, 'currentPlayer', 'current_player');
        $this->renameTable($this->oldTableName, $this->newTableName);

    }


    public function safeDown()
    {
        return false;
    }

}
