<?php

use yii\db\Migration;

/**
 * Class m210926_095110_change_column_name_in_wordCard
 */

class m210926_095110_change_column_name_in_wordCard extends Migration
{
    private $tableName = 'wordCard';
    private $oldColumnName = 'uni_id';
    private $newColumnName = 'field_id';

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
