<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[PatientRateGroup]].
 *
 * @see PatientRateGroup
 */
class PatientRateGroupQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PatientRateGroup[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PatientRateGroup|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
