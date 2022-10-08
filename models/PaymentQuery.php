<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Payment]].
 *
 * @see Payment
 */
class PaymentQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['is_deleted' => false]);
    }

    public function isTunai()
    {
        return $this->andWhere('pt.is_discount = false and pt.is_receivable = false');
    }

    public function isDiscount()
    {
        return $this->andWhere('pt.is_discount = true');
    }

    /**
     * {@inheritdoc}
     * @return Payment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Payment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
