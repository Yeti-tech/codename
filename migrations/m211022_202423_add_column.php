<?php

use yii\db\Migration;

/**
 * Class m211022_202423_add_column
 */
class m211022_202423_add_column extends Migration
{

    private
        $tableName = 'gameCard';
    public function safeUp()
    {
        $this->addColumn($this->tableName, 'colour_value', $this->string(250));
    }


    public function safeDown()
    {
        echo "m211022_202423_add_column cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211022_202423_add_column cannot be reverted.\n";

        return false;
    }
    */
}
