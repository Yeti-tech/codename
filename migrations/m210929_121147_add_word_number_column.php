<?php

use yii\db\Migration;

/**
 * Class m210929_121147_add_word_number_column
 */
class m210929_121147_add_word_number_column extends Migration
{
    private $tableName = 'game';
    private $columnName = 'words_number';

    public function safeUp(): bool
    {
        $this->addColumn($this->tableName, $this->columnName, $this->integer());

        return true;
    }


    public function safeDown(): bool
    {
        $this->dropColumn($this->tableName, $this->columnName);

        return false;
    }


}
