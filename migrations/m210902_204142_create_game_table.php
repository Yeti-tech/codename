<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%game}}`.
 */
class m210902_204142_create_game_table extends Migration
{
    private $tableName = 'game';

    public function safeUp(): bool
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'word' => $this->string(250)->notNull(),
        ]);
        return true;
    }

    public function safeDown(): bool
    {
        $this->dropTable($this->tableName);
        return false;
    }
}
