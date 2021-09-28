<?php

use yii\db\Migration;

/**
 * Class m210928_122048_rename_word_column
 */
class m210928_122048_rename_word_column extends Migration
{
    private $tableName = 'gameCard';
    private $oldColumnName = 'word';
    private $newColumnName = 'word_value';

    public function safeUp(): bool
    {
        $this->renameColumn($this->tableName, $this->oldColumnName, $this->newColumnName);

        return true;
    }

    public function safeDown(): bool
    {
        $this->renameColumn($this->tableName, $this->newColumnName, $this->oldColumnName);

        return false;
    }

}
