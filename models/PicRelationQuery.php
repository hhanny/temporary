<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[PicRelation]].
 *
 * @see PicRelation
 */
class PicRelationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PicRelation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PicRelation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
