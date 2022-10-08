<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[RegistrationInpatient]].
 *
 * @see RegistrationInpatient
 */
class RegistrationInpatientQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return RegistrationInpatient[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RegistrationInpatient|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
