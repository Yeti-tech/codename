<?php

use yii\db\Migration;

class m220112_091324_create_table_wordcard extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%wordcard}}',
            [
                'id' => $this->primaryKey(),
                'word_value' => $this->string(250)->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('word', '{{%wordcard}}', ['word_value'], true);
    }

    public function down()
    {
        $this->dropTable('{{%wordcard}}');
    }
}
