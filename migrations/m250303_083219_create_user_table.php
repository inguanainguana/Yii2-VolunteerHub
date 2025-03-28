<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m250303_083219_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'name'=> $this->string(),
            'surname'=> $this->string(),
            'patronymic'=> $this->string(),
            'username'=> $this->string(),
            'email'=> $this->string(),
            'phone_number'=> $this->string(),
            'password'=> $this->string(),
            'is_admin'=> $this->integer()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
