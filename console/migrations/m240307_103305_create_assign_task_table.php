<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%assign_task}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%employee}}`
 */
class m240307_103305_create_assign_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%assign_task}}', [
            'id' => $this->int(11),
            'task_name' => $this->string(512)->notNull(),
            'comment' => $this->text()()->notNull(),
            'assigned_to_employee' => $this->integer(11),
        ]);

        // creates index for column `assigned_to_employee`
        $this->createIndex(
            '{{%idx-assign_task-assigned_to_employee}}',
            '{{%assign_task}}',
            'assigned_to_employee'
        );

        // add foreign key for table `{{%employee}}`
        $this->addForeignKey(
            '{{%fk-assign_task-assigned_to_employee}}',
            '{{%assign_task}}',
            'assigned_to_employee',
            '{{%employee}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%employee}}`
        $this->dropForeignKey(
            '{{%fk-assign_task-assigned_to_employee}}',
            '{{%assign_task}}'
        );

        // drops index for column `assigned_to_employee`
        $this->dropIndex(
            '{{%idx-assign_task-assigned_to_employee}}',
            '{{%assign_task}}'
        );

        $this->dropTable('{{%assign_task}}');
    }
}
