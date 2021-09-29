<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%gameMode}}`.
 */
class m210928_232619_add_column_to_gameMode_table extends Migration
{
   private $tableName = 'gameMode';
   private $columnName = 'currentPlayer';

    public function safeUp(): bool
    {
        $this->addColumn($this->tableName, $this->columnName, $this->string());

        return true;
    }


    public function safeDown(): bool
    {
        $this->dropColumn($this->tableName, $this->columnName);

        return false;
    }
}
