<?php

use yii\db\Migration;

/**
 * Class m210925_101042_rename_table
 */
class m210925_101042_rename_table extends Migration
{
    private $oldTableName = 'wordfield';
    private $newTableName = 'wordCard';

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
