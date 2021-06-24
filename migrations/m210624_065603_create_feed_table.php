<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%feed}}`.
 */
class m210624_065603_create_feed_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%feed}}', [
            'id' => $this->primaryKey(),
            'feed_guid' => $this->string()->unique(),
            'title' => $this->string(),
            'link' => $this->string(),
            'short_description' => $this->text(),
            'date_published' => $this->dateTime(),
            'author' => $this->string(),
            'image_url' => $this->string(),
            'created_at' => $this->integer()->null(),
            'updated_at' => $this->integer()->null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%feed}}');
    }
}
