<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Registration]].
 *
 * @see Registration
 */
class RegistrationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Registration[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Registration|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
