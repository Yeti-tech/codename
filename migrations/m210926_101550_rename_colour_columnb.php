<?php

use yii\db\Migration;

/**
 * Class m210926_101550_rename_colour_columnb
 */
class m210926_101550_rename_colour_columnb extends Migration
{
    private $tableName = 'colourPattern';
    private $oldColumnName = 'colour';
    private $newColumnName = 'colour_value';

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
