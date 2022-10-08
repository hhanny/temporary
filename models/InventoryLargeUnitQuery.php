<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[InventoryLargeUnit]].
 *
 * @see InventoryLargeUnit
 */
class InventoryLargeUnitQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['is_active' => true])->orderBy('large_unit');
    }

    /**
     * {@inheritdoc}
     * @return InventoryLargeUnit[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return InventoryLargeUnit|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
