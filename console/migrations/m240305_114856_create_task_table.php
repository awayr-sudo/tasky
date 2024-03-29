<?php
use yii\db\Migration;

/**
 * Handles the creation of table `{{%task}}`.
 */
class m240305_114856_create_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(150),
            'description' => $this->text(),
            'due_date' => $this->date(),
            'user_id' => $this->integer(11),
            'list_id' => $this->integer(11),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);

        // Add foreign key constraints
        $this->addForeignKey(
            'fk-task-user_id',
            '{{%task}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-task-list_id',
            '{{%task}}',
            'list_id',
            '{{%table_lists}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%task}}');
    }
}
