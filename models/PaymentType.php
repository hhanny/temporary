<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payment_type".
 *
 * @property int $paytype_id
 * @property int $jtype_id
 * @property int $hospital_id
 * @property string $name
 * @property bool $is_active
 * @property string $description
 * @property int $s_order
 * @property bool $is_billing
 * @property bool $is_discount
 * @property bool $is_receivable is piutang => Asuransi selain bpjs kes
 * @property bool|null $is_bpjskes piutang untuk bpjskes
 * @property int|null $created_by
 * @property string|null $created_time
 * @property int|null $updated_by
 * @property string|null $updated_time
 * @property bool|null $is_deleted
 * @property int|null $deleted_by
 * @property string|null $deleted_time
 *
 * @property DebtPayment[] $debtPayments
 * @property Payment[] $payments
 * @property Hospital $hospital
 * @property JournalType $jtype
 * @property PurchaseOrder[] $purchaseOrders
 */
class PaymentType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jtype_id', 'hospital_id', 'name', 'is_active', 'description'], 'required'],
            [['jtype_id', 'hospital_id', 'created_by', 'updated_by', 'deleted_by'], 'default', 'value' => null],
            [['jtype_id', 'hospital_id', 'created_by', 'updated_by', 'deleted_by', 's_order'], 'integer'],
            [['is_active', 'is_billing', 'is_discount', 'is_receivable', 'is_bpjskes', 'is_deleted'], 'boolean'],
            [['description'], 'string'],
            [['created_time', 'updated_time', 'deleted_time'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['hospital_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hospital::className(), 'targetAttribute' => ['hospital_id' => 'hospital_id']],
            [['jtype_id'], 'exist', 'skipOnError' => true, 'targetClass' => JournalType::className(), 'targetAttribute' => ['jtype_id' => 'jtype_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'paytype_id' => Yii::t('app', 'Paytype ID'),
            'jtype_id' => Yii::t('app', 'Journal Type'),
            'hospital_id' => Yii::t('app', 'Hospital ID'),
            'name' => Yii::t('app', 'Name'),
            'is_active' => Yii::t('app', 'Is Active'),
            'description' => Yii::t('app', 'Description'),
            's_order' => Yii::t('app', 'S_Order'),
            'is_billing' => Yii::t('app', 'Is Billing'),
            'is_discount' => Yii::t('app', 'Is Discount'),
            'is_receivable' => Yii::t('app', 'is piutang => Asuransi selain bpjs kes'),
            'is_bpjskes' => Yii::t('app', 'piutang untuk bpjskes'),
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
     * Gets query for [[DebtPayments]].
     *
     * @return \yii\db\ActiveQuery|DebtPaymentQuery
     */
    public function getDebtPayments()
    {
        return $this->hasMany(DebtPayment::className(), ['paytype_id' => 'paytype_id']);
    }

    /**
     * Gets query for [[Payments]].
     *
     * @return \yii\db\ActiveQuery|PaymentQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payment::className(), ['paytype_id' => 'paytype_id']);
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
     * Gets query for [[Jtype]].
     *
     * @return \yii\db\ActiveQuery|JournalTypeQuery
     */
    public function getJtype()
    {
        return $this->hasOne(JournalType::className(), ['jtype_id' => 'jtype_id']);
    }

    /**
     * Gets query for [[PurchaseOrders]].
     *
     * @return \yii\db\ActiveQuery|PurchaseOrderQuery
     */
    public function getPurchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::className(), ['paytype_id' => 'paytype_id']);
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
     * @return PaymentTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PaymentTypeQuery(get_called_class());
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->created_by = Yii::$app->user->getId();
            $this->created_time = date('Y-m-d H:i:s');
        }
        $this->updated_by = Yii::$app->user->getId();
        $this->updated_time = date('Y-m-d H:i:s');
        return parent::beforeSave($insert);
    }
}
