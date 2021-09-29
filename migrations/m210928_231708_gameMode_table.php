<?php

use yii\db\Migration;

/**
 * Class m210928_231708_gameMode_table
 */
class m210928_231708_gameMode_table extends Migration
{
    private $tableName = 'gameMode';

    public function safeUp(): bool
    {
        $this->createTable($this->tableName, [
                'id' => $this->primaryKey(),
                'first_player' => $this->string(250),
                'second_player' => $this->string(250),
            ]);
        return true;
    }

    public function safeDown(): bool
    {

        $this->dropTable($this->tableName);
        return false;
    }

}
