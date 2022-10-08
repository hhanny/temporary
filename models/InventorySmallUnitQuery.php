<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[InventorySmallUnit]].
 *
 * @see InventorySmallUnit
 */
class InventorySmallUnitQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['is_active' => true])->orderBy('small_unit');
    }

    /**
     * {@inheritdoc}
     * @return InventorySmallUnit[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return InventorySmallUnit|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
