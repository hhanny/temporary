<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[NonPatient]].
 *
 * @see NonPatient
 */
class NonPatientQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return NonPatient[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return NonPatient|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
