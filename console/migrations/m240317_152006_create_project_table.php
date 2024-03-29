<?php
use yii\db\Migration;

/**
 * Handles the creation of table `{{%project}}`.
 */
class m240317_152006_create_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%project}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'details' => $this->text(),
            'assigned_to' => $this->integer()->notNull(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);

        // Add foreign key constraint for assigned_to column
        $this->addForeignKey(
            'fk-project-assigned_to-user',
            '{{%project}}',
            'assigned_to',
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
        $this->dropForeignKey('fk-project-assigned_to-user', '{{%project}}');
        $this->dropTable('{{%project}}');
    }
}

