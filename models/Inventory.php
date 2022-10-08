<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inventory".
 *
 * @property int $inv_id
 * @property int $hospital_id
 * @property string $name obat, barang, alkes dll
 * @property float $current_faktor presentase harga jual sekarang dengan harga beli terakhir
 * @property float $suggested_faktor presentase harga jual sekarang berdasarkan sk
 * @property string $internal_name
 * @property string $invgroup_id
 * @property string $invtype_id
 * @property string $largeunit_id
 * @property string $smallunit_id
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
 * @property InventoryGroup $invgroup
 * @property InventoryLargeUnit $largeunit
 * @property InventorySmallUnit $smallunit
 * @property User $createdBy
 * @property User $updatedBy
 * @property User $deletedBy
 * @property InventoryRate[] $inventoryRates
 */
class Inventory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inventory';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hospital_id', 'name', 'current_faktor', 'suggested_faktor', 'invgroup_id', 'largeunit_id', 'smallunit_id', 'internal_name'], 'required'],
            [['hospital_id', 'created_by', 'updated_by', 'deleted_by'], 'default', 'value' => null],
            [['hospital_id', 'invtype_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['current_faktor', 'suggested_faktor'], 'number'],
            [['created_time', 'updated_time', 'deleted_time'], 'safe'],
            [['is_deleted', 'is_active'], 'boolean'],
            [['name', 'internal_name'], 'string', 'max' => 255],
            [['invgroup_id'], 'string', 'max' => 2],
            [['largeunit_id', 'smallunit_id'], 'string', 'max' => 5],
            [['hospital_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hospital::className(), 'targetAttribute' => ['hospital_id' => 'hospital_id']],
            [['invgroup_id'], 'exist', 'skipOnError' => true, 'targetClass' => InventoryGroup::className(), 'targetAttribute' => ['invgroup_id' => 'invgroup_id']],
            [['largeunit_id'], 'exist', 'skipOnError' => true, 'targetClass' => InventoryLargeUnit::className(), 'targetAttribute' => ['largeunit_id' => 'largeunit_id']],
            [['smallunit_id'], 'exist', 'skipOnError' => true, 'targetClass' => InventorySmallUnit::className(), 'targetAttribute' => ['smallunit_id' => 'smallunit_id']],
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
            'inv_id' => Yii::t('app', 'Inv ID'),
            'hospital_id' => Yii::t('app', 'Hospital ID'),
            'name' => Yii::t('app', 'General Name'),
            'current_faktor' => Yii::t('app', 'CFaktor'),
            'suggested_faktor' => Yii::t('app', 'SFaktor'),
            'internal_name' => Yii::t('app', 'Internal Name'),
            'invgroup_id' => Yii::t('app', 'Group'),
            'invtype_id' => Yii::t('app', 'Type'),
            'largeunit_id' => Yii::t('app', 'Satuan Besar'),
            'smallunit_id' => Yii::t('app', 'Satuan Kecil'),
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
     * Gets query for [[Invgroup]].
     *
     * @return \yii\db\ActiveQuery|InventoryGroupQuery
     */
    public function getInvgroup()
    {
        return $this->hasOne(InventoryGroup::className(), ['invgroup_id' => 'invgroup_id']);
    }

    /**
     * Gets query for [[Invtype]].
     *
     * @return \yii\db\ActiveQuery|InventoryGroupQuery
     */
    public function getInvtype()
    {
        return $this->hasOne(InventoryType::className(), ['invtype_id' => 'invtype_id']);
    }

    /**
     * Gets query for [[Largeunit]].
     *
     * @return \yii\db\ActiveQuery|InventoryLargeUnitQuery
     */
    public function getLargeunit()
    {
        return $this->hasOne(InventoryLargeUnit::className(), ['largeunit_id' => 'largeunit_id']);
    }

    /**
     * Gets query for [[Smallunit]].
     *
     * @return \yii\db\ActiveQuery|InventorySmallUnitQuery
     */
    public function getSmallunit()
    {
        return $this->hasOne(InventorySmallUnit::className(), ['smallunit_id' => 'smallunit_id']);
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
     * Gets query for [[InventoryRates]].
     *
     * @return \yii\db\ActiveQuery|InventoryRateQuery
     */
    public function getInventoryRates()
    {
        return $this->hasMany(InventoryRate::className(), ['inv_id' => 'inv_id']);
    }

    /**
     * {@inheritdoc}
     * @return InventoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InventoryQuery(get_called_class());
    }

    public function beforeSave($insert)
    {
        $this->name = strtoupper($this->name);
        $this->internal_name = strtoupper($this->internal_name);
        if ($this->isNewRecord) {
            $this->created_by = Yii::$app->user->getId();
            $this->created_time = date('Y-m-d H:i:s');
        }
        $this->updated_by = Yii::$app->user->getId();
        $this->updated_time = date('Y-m-d H:i:s');
        return parent::beforeSave($insert);
    }
}
