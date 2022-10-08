<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[EmergencyReason]].
 *
 * @see EmergencyReason
 */
class EmergencyReasonQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return EmergencyReason[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return EmergencyReason|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
