<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "assign_task".
 *
 * @property int $id
 * @property string $task_name
 * @property string $comment
 * @property int|null $assigned_to_employee
 *
 * @property Employee $assignedToEmployee
 */
class AssignTask extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'assign_task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'task_name', 'comment'], 'required'],
            [['id', 'assigned_to_employee'], 'integer'],
            [['comment'], 'string'],
            [['task_name'], 'string', 'max' => 512],
            [['id'], 'unique'],
            [['assigned_to_employee'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::class, 'targetAttribute' => ['assigned_to_employee' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'task_name' => 'Task Name',
            'comment' => 'Comment',
            'assigned_to_employee' => 'Assigned To Employee',
        ];
    }

    /**
     * Gets query for [[AssignedToEmployee]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\EmployeeQuery
     */
    public function getAssignedToEmployee()
    {
        return $this->hasOne(Employee::class, ['id' => 'assigned_to_employee']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\AssignTaskQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\AssignTaskQuery(get_called_class());
    }
}
