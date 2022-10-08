<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Bed]].
 *
 * @see Bed
 */
class BedQuery extends \yii\db\ActiveQuery
{

    /**
     * {@inheritdoc}
     * @return Bed[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Bed|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
