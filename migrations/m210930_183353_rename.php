<?php

use yii\db\Migration;

/**
 * Class m210930_183353_rename
 */
class m210930_183353_rename extends Migration
{

    private $tableName = 'game';

    public function safeUp(): bool
    {
        $this->alterColumn($this->tableName, 'blue_cards', $this->integer());

        return true;
    }

    public function safeDown(): bool
    {
        return false;
    }

}
