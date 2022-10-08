<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[RegInpatientSource]].
 *
 * @see RegInpatientSource
 */
class RegInpatientSourceQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return RegInpatientSource[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RegInpatientSource|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
