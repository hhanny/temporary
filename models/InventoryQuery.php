<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Inventory]].
 *
 * @see Inventory
 */
class InventoryQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['is_active' => true]);
    }

    public function getList()
    {
        return $this->andWhere(['is_deleted' => false, 'hospital_id' => \Yii::$app->user->identity->hospital_id]);
    }

    /**
     * {@inheritdoc}
     * @return Inventory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Inventory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
