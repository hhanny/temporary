<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "purchase_order".
 *
 * @property int $po_id
 * @property int $hospital_id
 * @property string $po_num
 * @property string $po_date
 * @property int $supplier_id
 * @property int $unit_id
 * @property string|null $po_note
 * @property string|null $ref_num delivery order number/invoice number
 * @property string|null $ref_date
 * @property string|null $due_date jatuh tempo
 * @property string|null $pay_plan_date rencana bayar
 * @property string $potype_id
 * @property float|null $ppn_prosen
 * @property float|null $ppn_nominal
 * @property string|null $receive_date
 * @property string|null $tax_num faktur pajak
 * @property int $paytype_id jenis membayar
 * @property int|null $created_by
 * @property string|null $created_time
 * @property int|null $updated_by
 * @property string|null $updated_time
 * @property bool|null $is_deleted
 * @property int|null $deleted_by
 * @property string|null $deleted_time
 *
 * @property Hospital $hospital
 * @property PaymentType $paytype
 * @property PurchaseOrderType $potype
 * @property Supplier $supplier
 * @property Unit $unit
 * @property User $createdBy
 * @property User $updatedBy
 * @property User $deletedBy
 */
class PurchaseOrder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'purchase_order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hospital_id', 'po_num', 'po_date', 'supplier_id', 'unit_id', 'potype_id', 'paytype_id'], 'required'],
            [['hospital_id', 'supplier_id', 'unit_id', 'paytype_id', 'created_by', 'updated_by', 'deleted_by'], 'default', 'value' => null],
            [['hospital_id', 'supplier_id', 'unit_id', 'paytype_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['po_date', 'ref_date', 'due_date', 'pay_plan_date', 'receive_date', 'created_time', 'updated_time', 'deleted_time'], 'safe'],
            [['po_note'], 'string'],
            [['ppn_prosen', 'ppn_nominal'], 'number'],
            [['is_deleted'], 'boolean'],
            [['po_num', 'ref_num'], 'string', 'max' => 50],
            [['potype_id'], 'string', 'max' => 2],
            [['tax_num'], 'string', 'max' => 100],
            [['hospital_id', 'po_num'], 'unique', 'targetAttribute' => ['hospital_id', 'po_num']],
            [['hospital_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hospital::className(), 'targetAttribute' => ['hospital_id' => 'hospital_id']],
            [['paytype_id'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentType::className(), 'targetAttribute' => ['paytype_id' => 'paytype_id']],
            [['potype_id'], 'exist', 'skipOnError' => true, 'targetClass' => PurchaseOrderType::className(), 'targetAttribute' => ['potype_id' => 'potype_id']],
            [['supplier_id'], 'exist', 'skipOnError' => true, 'targetClass' => Supplier::className(), 'targetAttribute' => ['supplier_id' => 'supplier_id']],
            [['unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => Unit::className(), 'targetAttribute' => ['unit_id' => 'unit_id']],
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
            'po_id' => Yii::t('app', 'POID'),
            'hospital_id' => Yii::t('app', 'Hospital ID'),
            'po_num' => Yii::t('app', 'Po NUM'),
            'po_date' => Yii::t('app', 'Po Date'),
            'supplier_id' => Yii::t('app', 'Supplier'),
            'unit_id' => Yii::t('app', 'Unit'),
            'po_note' => Yii::t('app', 'Note'),
            'ref_num' => Yii::t('app', 'delivery order number/invoice number'),
            'ref_date' => Yii::t('app', 'Ref Date'),
            'due_date' => Yii::t('app', 'Jatuh Tempo'),
            'pay_plan_date' => Yii::t('app', 'Rencana Bayar'),
            'potype_id' => Yii::t('app', 'Type'),
            'ppn_prosen' => Yii::t('app', 'Ppn Prosen'),
            'ppn_nominal' => Yii::t('app', 'Ppn Nominal'),
            'receive_date' => Yii::t('app', 'Receive Date'),
            'tax_num' => Yii::t('app', 'Faktur Pajak'),
            'paytype_id' => Yii::t('app', 'jenis membayar'),
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
     * Gets query for [[Paytype]].
     *
     * @return \yii\db\ActiveQuery|PaymentTypeQuery
     */
    public function getPaytype()
    {
        return $this->hasOne(PaymentType::className(), ['paytype_id' => 'paytype_id']);
    }

    /**
     * Gets query for [[Potype]].
     *
     * @return \yii\db\ActiveQuery|PurchaseOrderTypeQuery
     */
    public function getPotype()
    {
        return $this->hasOne(PurchaseOrderType::className(), ['potype_id' => 'potype_id']);
    }

    /**
     * Gets query for [[Supplier]].
     *
     * @return \yii\db\ActiveQuery|SupplierQuery
     */
    public function getSupplier()
    {
        return $this->hasOne(Supplier::className(), ['supplier_id' => 'supplier_id']);
    }

    /**
     * Gets query for [[Unit]].
     *
     * @return \yii\db\ActiveQuery|UnitQuery
     */
    public function getUnit()
    {
        return $this->hasOne(Unit::className(), ['unit_id' => 'unit_id']);
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
     * @return PurchaseOrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PurchaseOrderQuery(get_called_class());
    }
}
