<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%field}}`.
 */
class m210902_202908_create_field_table extends Migration
{
    private $tableName = 'field';

    public function safeUp(): bool
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'word' => $this->string(250)->notNull()->unique(),
        ]);
        return true;
    }

    public function safeDown(): bool
    {
        $this->dropTable($this->tableName);
        return false;
    }
}
