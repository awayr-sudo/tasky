<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%employee}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m240307_093222_create_employee_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%employee}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'role' => $this->string(),
            'email_address' => $this->string(255)->notNull(),
            'user_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-employee-user_id}}',
            '{{%employee}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-employee-user_id}}',
            '{{%employee}}',
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
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-employee-user_id}}',
            '{{%employee}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-employee-user_id}}',
            '{{%employee}}'
        );

        $this->dropTable('{{%employee}}');
    }
}
