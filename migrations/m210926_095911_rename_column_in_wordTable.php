<?php

use yii\db\Migration;

/**
 * Class m210926_095911_rename_column_in_wordTable
 */
class m210926_095911_rename_column_in_wordTable extends Migration
{

    private $tableName = 'wordCard';
    private $oldColumnName = 'word';
    private $newColumnName = 'word_value';

    public function safeUp(): bool
    {
        $this->renameColumn($this->tableName, $this->oldColumnName, $this->newColumnName);

        return true;

    }


    public function safeDown(): bool
    {
        $this->renameColumn($this->tableName, $$this->newColumnName, $this->oldColumnName);

        return false;
    }

}
