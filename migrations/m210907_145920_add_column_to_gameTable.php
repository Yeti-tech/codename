<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%game}}`.
 */
class m210907_145920_add_column_to_gameTable extends Migration
{
   private $tableName = 'game';

    public function safeUp(): bool
    {
        $this->addColumn($this->tableName, 'uni_id', $this->string());
        return true;
    }


    public function safeDown(): bool
    {
        $this->dropColumn($this->tableName, 'uni_id');
        return false;
    }
}
