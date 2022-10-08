<?php

namespace app\models;

use Yii;
use app\models\Registration;

/**
 * This is the ActiveQuery class for [[Unit]].
 *
 * @see Unit
 */
class UnitQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    public function clinic()
    {
        return $this->andWhere('unitgroup_id != :p1 and is_clinic = :p2 and hospital_id = :p3', [':p1' => Registration::UG_IGD, ':p2' => true, ':p3' => Yii::$app->user->identity->hospital_id]);
    }

    public function struktural()
    {
        return $this->andWhere('is_clinic = :p1 and hospital_id = :p2 and is_active = :p3', [':p1' => false, ':p2' => Yii::$app->user->identity->hospital_id, ':p3' => true]);
    }

    /**
     * {@inheritdoc}
     * @return Unit[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Unit|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
