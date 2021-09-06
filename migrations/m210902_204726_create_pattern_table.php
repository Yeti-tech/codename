<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pattern}}`.
 */
class m210902_204726_create_pattern_table extends Migration
{
    private $tableName = 'pattern';

    public function safeUp(): bool
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'colour' => $this->string(250)->notNull(),
            'field_id' => $this->integer(),
        ]);
        return true;
    }

    public function safeDown(): bool
    {
        $this->dropTable($this->tableName);
        return false;
    }
}
