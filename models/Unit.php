<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "unit".
 *
 * @property int $unit_id
 * @property int $hospital_id
 * @property string $unit_code
 * @property string $unitgroup_id
 * @property string $unit_name
 * @property bool $is_active
 * @property bool|null $is_clinic
 * @property string|null $description
 * @property int|null $created_by
 * @property string|null $created_time
 * @property int|null $updated_by
 * @property string|null $updated_time
 * @property bool|null $is_deleted
 * @property int|null $deleted_by
 * @property string|null $deleted_time
 *
 * @property PurchaseOrder[] $purchaseOrders
 * @property Registration[] $registrations
 * @property Hospital $hospital
 * @property UnitGroup $unitgroup
 * @property User $createdBy
 * @property User $updatedBy
 * @property User $deletedBy
 */
class Unit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'unit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hospital_id', 'unit_code', 'unitgroup_id', 'unit_name'], 'required'],
            [['hospital_id', 'created_by', 'updated_by', 'deleted_by'], 'default', 'value' => null],
            [['hospital_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['is_active', 'is_clinic', 'is_deleted'], 'boolean'],
            [['created_time', 'updated_time', 'deleted_time'], 'safe'],
            [['unit_code', 'unitgroup_id'], 'string', 'max' => 5],
            [['unit_name'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 255],
            [['hospital_id', 'unit_code'], 'unique', 'targetAttribute' => ['hospital_id', 'unit_code']],
            [['hospital_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hospital::className(), 'targetAttribute' => ['hospital_id' => 'hospital_id']],
            [['unitgroup_id'], 'exist', 'skipOnError' => true, 'targetClass' => UnitGroup::className(), 'targetAttribute' => ['unitgroup_id' => 'unitgroup_id']],
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
            'unit_id' => Yii::t('app', 'Unit ID'),
            'hospital_id' => Yii::t('app', 'Hospital ID'),
            'unit_code' => Yii::t('app', 'Unit Code'),
            'unitgroup_id' => Yii::t('app', 'Unitgroup ID'),
            'unit_name' => Yii::t('app', 'Unit Name'),
            'is_active' => Yii::t('app', 'Is Active'),
            'is_clinic' => Yii::t('app', 'Is Clinic'),
            'description' => Yii::t('app', 'Description'),
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
     * Gets query for [[PurchaseOrders]].
     *
     * @return \yii\db\ActiveQuery|PurchaseOrderQuery
     */
    public function getPurchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::className(), ['unit_id' => 'unit_id']);
    }

    /**
     * Gets query for [[Registrations]].
     *
     * @return \yii\db\ActiveQuery|RegistrationQuery
     */
    public function getRegistrations()
    {
        return $this->hasMany(Registration::className(), ['unit_id' => 'unit_id']);
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
     * Gets query for [[Unitgroup]].
     *
     * @return \yii\db\ActiveQuery|UnitGroupQuery
     */
    public function getUnitgroup()
    {
        return $this->hasOne(UnitGroup::className(), ['unitgroup_id' => 'unitgroup_id']);
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
     * @return UnitQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UnitQuery(get_called_class());
    }

    public function beforeSave($insert)
    {
        $this->unit_code = strtoupper($this->unit_code);
        if ($this->isNewRecord) {
            $this->created_by = Yii::$app->user->getId();
            $this->created_time = date('Y-m-d H:i:s');
        }
        $this->updated_by = Yii::$app->user->getId();
        $this->updated_time = date('Y-m-d H:i:s');
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public static function getActive()
    {
        return self::find()->where(['is_active' => true, 'hospital_id' => Yii::$app->user->identity->hospital_id])->all();
    }
}
