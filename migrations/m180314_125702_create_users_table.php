<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users`.
 */
class m180314_125702_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey()->unsigned(),
            'username' => $this->string()->unique(),
            'password' => $this->string()->notNull(),
            'authKey' => $this->string()->notNull(),
            'accessToken' => $this->string()->notNull(),
            'balance' => $this->float('5,2')->defaultValue(0.00),
        ] );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');
    }
}
