<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $due_date
 * @property int|null $user_id
 * @property int|null $list_id
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property TableLists $list
 * @property User $user
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */

    public function rules()
    {
        return [
            [['description'], 'string'],
            [['due_date', 'created_at', 'updated_at'], 'safe'],
            [['user_id', 'list_id'], 'integer'],
            [['title'], 'string', 'max' => 150],
            [['list_id'], 'exist', 'skipOnError' => true, 'targetClass' => TableLists::class, 'targetAttribute' => ['list_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'due_date' => 'Due Date',
            'user_id' => 'User ID',
            'list_id' => 'List ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[List]].
     *
     * @return \yii\db\ActiveQuery|TableListsQuery
     */
    public function getList()
    {
        return $this->hasOne(TableLists::class, ['id' => 'list_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return TaskQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TaskQuery(get_called_class());
    }
}
