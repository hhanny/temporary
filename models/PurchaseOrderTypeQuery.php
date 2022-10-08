<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[PurchaseOrderType]].
 *
 * @see PurchaseOrderType
 */
class PurchaseOrderTypeQuery extends \yii\db\ActiveQuery
{
    public function isPharmacy()
    {
        return $this->andWhere(['is_active' => true, 'is_pharmacy' => true]);
    }

    public function getList()
    {
        return $this->andWhere(['is_deleted' => false]);
    }

    /**
     * {@inheritdoc}
     * @return PurchaseOrderType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PurchaseOrderType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
