<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[RegistrationStatus]].
 *
 * @see RegistrationStatus
 */
class RegistrationStatusQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return RegistrationStatus[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RegistrationStatus|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
