<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%event}}`.
 */
class m250304_040414_create_event_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%event}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->text(),
            'start_date' => $this->dateTime(),
            'end_date' => $this->dateTime(),
            'location' => $this->string(),
            'image' => $this->string(),
            'user_id' => $this->integer(),
        ]);
        $this->addForeignKey(
            'user_id_event_fk',
            '{{%event}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%event}}');
    }
}
