<?php

use yii\db\Migration;

/**
 * Class m210926_101050_rename_field_id_columns
 */
class m210926_101050_rename_field_id_columns extends Migration
{
    private $tableName = 'wordCard';
    private $secondTableName = 'colourPattern';
    private $oldColumnName = 'field_id';
    private $newColumnName = 'uni_id';

    public function safeUp(): bool
    {
        $this->renameColumn($this->tableName, $this->oldColumnName, $this->newColumnName);
        $this->renameColumn($this->secondTableName, $this->oldColumnName, $this->newColumnName);

        return true;

    }


    public function safeDown(): bool
    {
        $this->renameColumn($this->tableName, $$this->newColumnName, $this->oldColumnName);
        $this->renameColumn($this->secondtableName, $this->newColumnName, $this->oldColumnName,);

        return false;
    }

}
