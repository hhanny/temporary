<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inventory_rate".
 *
 * @property int $invrate_id
 * @property int|null $hospital_id
 * @property int|null $inv_id
 * @property string|null $start_date
 * @property string|null $end_date
 * @property string|null $sk_num
 * @property float|null $suggested_factor
 * @property float|null $current_factor
 * @property float|null $price_nominal
 * @property bool|null $is_active
 * @property int|null $created_by
 * @property string|null $created_time
 * @property int|null $updated_by
 * @property string|null $updated_time
 * @property bool|null $is_deleted
 * @property int|null $deleted_by
 * @property string|null $deleted_time
 *
 * @property Hospital $hospital
 * @property Inventory $inv
 * @property User $createdBy
 * @property User $updatedBy
 * @property User $deletedBy
 */
class InventoryRate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inventory_rate';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hospital_id', 'inv_id', 'created_by', 'updated_by', 'deleted_by'], 'default', 'value' => null],
            [['hospital_id', 'inv_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['start_date', 'end_date', 'created_time', 'updated_time', 'deleted_time'], 'safe'],
            [['suggested_factor', 'current_factor', 'price_nominal'], 'number'],
            [['is_active', 'is_deleted'], 'boolean'],
            [['sk_num'], 'string', 'max' => 50],
            [['inv_id', 'hospital_id', 'is_active'], 'unique', 'targetAttribute' => ['inv_id', 'hospital_id', 'is_active']],
            [['hospital_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hospital::className(), 'targetAttribute' => ['hospital_id' => 'hospital_id']],
            [['inv_id'], 'exist', 'skipOnError' => true, 'targetClass' => Inventory::className(), 'targetAttribute' => ['inv_id' => 'inv_id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'user_id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'user_id']],
            [['deleted_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['deleted_by' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'invrate_id' => Yii::t('app', 'Invrate ID'),
            'hospital_id' => Yii::t('app', 'Hospital ID'),
            'inv_id' => Yii::t('app', 'Inv ID'),
            'start_date' => Yii::t('app', 'Start Date'),
            'end_date' => Yii::t('app', 'End Date'),
            'sk_num' => Yii::t('app', 'Sk Num'),
            'suggested_factor' => Yii::t('app', 'Suggested Factor'),
            'current_factor' => Yii::t('app', 'Current Factor'),
            'price_nominal' => Yii::t('app', 'Price Nominal'),
            'is_active' => Yii::t('app', 'Is Active'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_time' => Yii::t('app', 'Created Time'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_time' => Yii::t('app', 'Updated Time'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'deleted_by' => Yii::t('app', 'Deleted By'),
            'deleted_time' => Yii::t('app', 'Deleted Time'),
        ];
    }

    /**
     * Gets query for [[Hospital]].
     *
     * @return \yii\db\ActiveQuery|HospitalQuery
     */
    public function getHospital()
    {
        return $this->hasOne(Hospital::className(), ['hospital_id' => 'hospital_id']);
    }

    /**
     * Gets query for [[Inv]].
     *
     * @return \yii\db\ActiveQuery|InventoryQuery
     */
    public function getInv()
    {
        return $this->hasOne(Inventory::className(), ['inv_id' => 'inv_id']);
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|UsersQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['user_id' => 'created_by']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery|UsersQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['user_id' => 'updated_by']);
    }

    /**
     * Gets query for [[DeletedBy]].
     *
     * @return \yii\db\ActiveQuery|UsersQuery
     */
    public function getDeletedBy()
    {
        return $this->hasOne(User::className(), ['user_id' => 'deleted_by']);
    }

    /**
     * {@inheritdoc}
     * @return InventoryRateQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InventoryRateQuery(get_called_class());
    }
}
