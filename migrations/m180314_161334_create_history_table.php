<?php

use yii\db\Migration;

/**
 * Handles the creation of table `history`.
 */
class m180314_161334_create_history_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('history', [
            'id' => $this->primaryKey()->unsigned(),
            'user_id' => $this->integer()->unsigned(),
            'receiver_id' => $this->integer()->unsigned(),
            'amount' => $this->float('5,2'),
            'date' => $this->dateTime()
        ]);

        $this->addForeignKey(
            'fk-history-user_id',
            'history',
            'user_id',
            'users',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-history-receiver_id',
            'history',
            'receiver_id',
            'users',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-history-user_id',
            'history'
        );
        $this->dropForeignKey(
            'fk-history-receiver_id',
            'history'
        );
        $this->dropTable('history');
    }
}
