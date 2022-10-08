<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Journal]].
 *
 * @see Journal
 */
class JournalQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['hospital_id' => \Yii::$app->user->identity->hospital_id, 'is_deleted' => false]);
    }

    /**
     * {@inheritdoc}
     * @return Journal[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Journal|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
