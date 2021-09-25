<?php

use yii\db\Migration;

/**
 * Class m210925_105108_rename_game_table
 */

class m210925_105108_rename_game_table extends Migration
{
    private $oldTableName = 'game';
    private $newTableName = 'gameCard';

    public function safeUp(): bool
    {
        $this->renameTable($this->oldTableName, $this->newTableName);

        return true;
    }

    public function safeDown(): bool
    {
        $this->renameTable($this->newTableName, $this->oldTableName);

        return false;
    }

}
