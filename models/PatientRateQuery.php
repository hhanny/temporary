<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[PatientRate]].
 *
 * @see PatientRate
 */
class PatientRateQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PatientRate[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PatientRate|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
