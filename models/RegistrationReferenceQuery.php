<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[RegistrationReference]].
 *
 * @see RegistrationReference
 */
class RegistrationReferenceQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return RegistrationReference[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RegistrationReference|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
