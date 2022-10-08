<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[InventoryType]].
 *
 * @see InventoryType
 */
class InventoryTypeQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['is_active' => true, 'hospital_id' => \Yii::$app->user->identity->hospital_id]);
    }

    /**
     * {@inheritdoc}
     * @return InventoryType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return InventoryType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
