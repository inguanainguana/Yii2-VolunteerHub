<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%event_registrations}}`.
 */
class m250304_041923_create_event_registrations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%event_registrations}}', [
            'id' => $this->primaryKey(),
            'event_id' => $this->integer(),
            'user_id' => $this->integer(),
            'registration_date' => $this->dateTime(),
            'status' => $this->string()->defaultValue(1),
        ]);
        $this->addForeignKey(
            'event_id_event_registrations_fk',
            '{{%event_registrations}}',
            'event_id',
            '{{%event}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'user_id_event_registrations_fk',
            '{{%event_registrations}}',
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
        $this->dropTable('{{%event_registrations}}');
    }
}
