<?php

namespace app\models;

use Yii;

/**
 * This is the ActiveQuery class for [[JournalType]].
 *
 * @see JournalType
 */
class JournalTypeQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['is_active' => true, 'hospital_id' => Yii::$app->user->identity->hospital_id, 'is_deleted' => false]);
    }

    /**
     * {@inheritdoc}
     * @return JournalType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return JournalType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
