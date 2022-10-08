<?php

namespace app\models;

use app\components\Formatter;
use phpDocumentor\Reflection\Types\This;
use Yii;

/**
 * This is the model class for table "billing".
 *
 * @property int $billing_id
 * @property string|null $registration_id
 * @property int|null $prdrate_id
 * @property int|null $nonpatient_id
 * @property bool|null $is_patient
 * @property float|null $nominal
 * @property int|null $volume
 * @property float|null $total
 * @property int|null $created_by
 * @property string|null $created_time
 * @property int|null $updated_by
 * @property string|null $updated_time
 * @property bool|null $is_deleted
 * @property int|null $deleted_by
 * @property string|null $deleted_time
 * @property int|null $inv_id transaksi alkes/obat dimasukan ke billing
 * @property string|null $unitgroup_id
 *
 * @property NonPatient $nonpatient
 * @property ProductRate $prdrate
 * @property UnitGroup $unitgroup
 * @property User $createdBy
 * @property User $updatedBy
 * @property User $deletedBy
 */
class Billing extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'billing';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prdrate_id', 'nonpatient_id', 'volume', 'created_by', 'updated_by', 'deleted_by', 'inv_id'], 'default', 'value' => null],
            [['prdrate_id', 'nonpatient_id', 'volume', 'created_by', 'updated_by', 'deleted_by', 'inv_id', 'registration_id'], 'integer'],
            [['is_patient', 'is_deleted'], 'boolean'],
            [['nominal', 'total'], 'number'],
            [['created_time', 'updated_time', 'deleted_time'], 'safe'],
            [['unitgroup_id'], 'string', 'max' => 5],
            [['nonpatient_id'], 'exist', 'skipOnError' => true, 'targetClass' => NonPatient::className(), 'targetAttribute' => ['nonpatient_id' => 'nonpatient_id']],
            [['prdrate_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductRate::className(), 'targetAttribute' => ['prdrate_id' => 'prdrate_id']],
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
            'billing_id' => Yii::t('app', 'Billing ID'),
            'registration_id' => Yii::t('app', 'Registration ID'),
            'prdrate_id' => Yii::t('app', 'Produk'),
            'nonpatient_id' => Yii::t('app', 'Nonpatient ID'),
            'is_patient' => Yii::t('app', 'Is Patient'),
            'nominal' => Yii::t('app', 'Nominal'),
            'volume' => Yii::t('app', 'Volume'),
            'total' => Yii::t('app', 'Total'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_time' => Yii::t('app', 'Created Time'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_time' => Yii::t('app', 'Updated Time'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'deleted_by' => Yii::t('app', 'Deleted By'),
            'deleted_time' => Yii::t('app', 'Deleted Time'),
            'inv_id' => Yii::t('app', 'transaksi alkes/obat dimasukan ke billing'),
            'unitgroup_id' => Yii::t('app', 'Unitgroup ID'),
        ];
    }

    /**
     * Gets query for [[Nonpatient]].
     *
     * @return \yii\db\ActiveQuery|NonPatientQuery
     */
    public function getNonpatient()
    {
        return $this->hasOne(NonPatient::className(), ['nonpatient_id' => 'nonpatient_id']);
    }

    /**
     * Gets query for [[Prdrate]].
     *
     * @return \yii\db\ActiveQuery|ProductRateQuery
     */
    public function getPrdrate()
    {
        return $this->hasOne(ProductRate::className(), ['prdrate_id' => 'prdrate_id']);
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
     * @return BillingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BillingQuery(get_called_class());
    }

    public function beforeSave($insert)
    {
        if (!empty($this->created_time)) {
            $this->created_time = date('Y-m-d H:i:s', strtotime($this->created_time));
        }
        if ($this->isNewRecord) {
            $this->created_by = Yii::$app->user->getId();
            $this->created_time = date('Y-m-d H:i:s');
        }
        $this->updated_by = Yii::$app->user->getId();
        $this->updated_time = date('Y-m-d H:i:s');
        $this->nominal = Formatter::unformatNumber($this->nominal);
        $this->volume = Formatter::unformatNumber($this->volume);
        $this->total = Formatter::unformatNumber($this->total);
        $this->updated_by = Yii::$app->user->getId();
        $this->updated_time = date('Y-m-d H:i:s');
        return parent::beforeSave($insert);
    }

    public function afterFind()
    {
        $this->nominal = Formatter::formatNumber($this->nominal);
        $this->volume = Formatter::formatNumber($this->volume);
        $this->total = Formatter::formatNumber($this->total);
        $this->created_time = date('d-m-Y H:i', strtotime($this->created_time));
        parent::afterFind();
    }
}
