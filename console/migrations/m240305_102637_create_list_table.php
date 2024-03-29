<?php
use yii\db\Migration;

/**
 * Handles the creation of table `{{%table_lists}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m240305_102637_create_table_lists_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%table_lists}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'description' => $this->text(),
            'created_by' => $this->integer(11)->notNull(),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        // creates index for column `created_by`
        $this->createIndex(
            'idx-table_lists-created_by',
            '{{%table_lists}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            'fk-table_lists-created_by',
            '{{%table_lists}}',
            'created_by',
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
            'fk-table_lists-created_by',
            '{{%table_lists}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            'idx-table_lists-created_by',
            '{{%table_lists}}'
        );

        $this->dropTable('{{%table_lists}}');
    }
}