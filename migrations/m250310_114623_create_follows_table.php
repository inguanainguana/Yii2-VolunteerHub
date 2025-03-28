<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%follows}}`.
 */
class m250310_114623_create_follows_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%follows}}', [
            'id' => $this->primaryKey(),
            'user_id'=> $this->integer(),
            'followed_id' => $this->integer(),
        ]);
        $this->addForeignKey(
            'user_id_follows_fk',
            '{{%follows}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'followed_id_follows_fk',
            '{{%follows}}',
            'followed_id',
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
        $this->dropTable('{{%follows}}');
    }
}
