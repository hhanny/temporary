<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Emergency]].
 *
 * @see Emergency
 */
class EmergencyQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Emergency[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Emergency|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
