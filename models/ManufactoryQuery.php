<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Manufactory]].
 *
 * @see Manufactory
 */
class ManufactoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Manufactory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Manufactory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
