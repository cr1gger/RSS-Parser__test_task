<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%parser_logs}}`.
 */
class m210624_065912_create_parser_logs_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%parser_logs}}', [
            'id' => $this->primaryKey(),
            'request_method' => $this->string(),
            'request_url' => $this->string(),
            'response_code' => $this->string(),
            'response_body' => $this->text(),
            'created_at' => $this->integer()->null(),
            'updated_at' => $this->integer()->null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%parser_logs}}');
    }
}
