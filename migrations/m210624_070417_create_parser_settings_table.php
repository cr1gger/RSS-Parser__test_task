<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%parser_settings}}`.
 */
class m210624_070417_create_parser_settings_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%parser_settings}}', [
            'id' => $this->primaryKey(),
            'start_parsing_time' => $this->time(),
        ]);
        $this->insert('{{%parser_settings}}',[
            'start_parsing_time' => '15:00:00'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%parser_settings}}');
    }
}
