<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Ethnic]].
 *
 * @see Ethnic
 */
class EthnicQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Ethnic[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Ethnic|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
