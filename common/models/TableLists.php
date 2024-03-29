<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "table_lists".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $created_by
 * @property string $updated_at
 *
 * @property User $createdBy
 */
class TableLists extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'table_lists';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'created_by'], 'required'],
            [['description'], 'string'],
            [['created_by'], 'integer'],
            [['updated_at'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * {@inheritdoc}
     * @return TableListsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TableListsQuery(get_called_class());
    }
}
