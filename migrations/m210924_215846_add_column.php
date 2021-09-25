<?php

use yii\db\Migration;

/**
 * Class m210924_215846_add_column
 */
class m210924_215846_add_column extends Migration
{
    private $tableName = 'game';

    public function safeUp(): bool
    {
        $this->addColumn($this->tableName, 'deactivated', $this->boolean()->defaultValue(false));

        return true;

    }

    public function safeDown(): bool
    {
        $this->dropColumn($this->tableName, 'deactivated');

        return false;
    }


}
