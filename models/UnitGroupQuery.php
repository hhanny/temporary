<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[UnitGroup]].
 *
 * @see UnitGroup
 */
class UnitGroupQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['is_active' => true]);
    }

    public function getList()
    {
        return $this->andWhere(['is_deleted' => false]);
    }

    public function getPoli()
    {
        return $this->andWhere('is_active = :p1 and unitgroup_id != :p2', [':p1' => true, ':p2' => Registration::UG_IGD]);
    }

    /**
     * {@inheritdoc}
     * @return UnitGroup[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UnitGroup|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
