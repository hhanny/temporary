<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[PurchaseOrder]].
 *
 * @see PurchaseOrder
 */
class PurchaseOrderQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PurchaseOrder[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PurchaseOrder|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
