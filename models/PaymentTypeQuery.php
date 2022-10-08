<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[PaymentType]].
 *
 * @see PaymentType
 */
class PaymentTypeQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['hospital_id' => \Yii::$app->user->identity->hospital_id, 'is_active' => true])->orderBy('s_order asc');
    }

    /**
     * {@inheritdoc}
     * @return PaymentType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PaymentType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
