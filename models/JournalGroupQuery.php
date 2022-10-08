<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[JournalGroup]].
 *
 * @see JournalGroup
 */
class JournalGroupQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['is_active' => true]);
    }

    /**
     * {@inheritdoc}
     * @return JournalGroup[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return JournalGroup|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
