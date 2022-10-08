<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[JournalDetail]].
 *
 * @see JournalDetail
 */
class JournalDetailQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return JournalDetail[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return JournalDetail|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
