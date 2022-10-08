<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $product_id
 * @property int $hospital_id
 * @property string $unitgroup_id
 * @property int $coa_id
 * @property string $name
 * @property bool $is_active
 * @property int|null $created_by
 * @property string|null $created_time
 * @property int|null $updated_by
 * @property string|null $updated_time
 * @property bool|null $is_deleted
 * @property int|null $deleted_by
 * @property string|null $deleted_time
 *
 * @property ChartOfAccount $coa
 * @property Hospital $hospital
 * @property UnitGroup $unitgroup
 * @property User $createdBy
 * @property User $updatedBy
 * @property User $deletedBy
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hospital_id', 'unitgroup_id', 'coa_id', 'name'], 'required'],
            [['hospital_id', 'coa_id', 'created_by', 'updated_by', 'deleted_by'], 'default', 'value' => null],
            [['hospital_id', 'coa_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['is_active', 'is_deleted'], 'boolean'],
            [['created_time', 'updated_time', 'deleted_time'], 'safe'],
            [['unitgroup_id'], 'string', 'max' => 5],
            [['name'], 'string', 'max' => 100],
            [['coa_id'], 'exist', 'skipOnError' => true, 'targetClass' => ChartOfAccount::className(), 'targetAttribute' => ['coa_id' => 'coa_id']],
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
            'product_id' => Yii::t('app', 'PRDID'),
            'hospital_id' => Yii::t('app', 'Hospital'),
            'unitgroup_id' => Yii::t('app', 'Unit Group'),
            'coa_id' => Yii::t('app', 'COA'),
            'name' => Yii::t('app', 'Name'),
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
     * Gets query for [[Coa]].
     *
     * @return \yii\db\ActiveQuery|ChartOfAccountQuery
     */
    public function getCoa()
    {
        return $this->hasOne(ChartOfAccount::className(), ['coa_id' => 'coa_id']);
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
     * @return ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductQuery(get_called_class());
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->created_by = Yii::$app->user->getId();
            $this->created_time = date('Y-m-d H:i:s');
        }
        $this->name = strtoupper($this->name);
        $this->updated_by = Yii::$app->user->getId();
        $this->updated_time = date('Y-m-d H:i:s');
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public static function getActive()
    {
        return self::find()->orderBy('name')->where(['hospital_id' => Yii::$app->user->identity->hospital_id, 'is_active' => true])->all();
    }
}
