<?php

use yii\db\Migration;

/**
 * Class m210927_100628_new_test_table
 */
class m210927_100628_new_test_table extends Migration
{

    private $tableName = 'testTable';

    public function safeUp(): bool
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'test' => $this->string(250),
        ]);
        return true;
    }

    public function safeDown()
    {
        return false;
    }

}
