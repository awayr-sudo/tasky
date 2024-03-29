<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[TableLists]].
 *
 * @see TableLists
 */
class TableListsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TableLists[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TableLists|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
