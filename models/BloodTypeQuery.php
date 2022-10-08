<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[BloodType]].
 *
 * @see BloodType
 */
class BloodTypeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BloodType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BloodType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
