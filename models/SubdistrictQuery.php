<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Subdistrict]].
 *
 * @see Subdistrict
 */
class SubdistrictQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Subdistrict[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Subdistrict|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
