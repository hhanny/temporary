<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[InventoryGroup]].
 *
 * @see InventoryGroup
 */
class InventoryGroupQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return InventoryGroup[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return InventoryGroup|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
