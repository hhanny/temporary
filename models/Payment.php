<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payment".
 *
 * @property int $payment_id
 * @property int $paytype_id
 * @property int $registration_id
 * @property int|null $nonpatient_id diisi nonpatient_id jika bukan pasien
 * @property bool $is_patient
 * @property string $description
 * @property float $nominal
 * @property int|null $hospital_id
 * @property int|null $journal_id
 * @property int|null $created_by
 * @property string|null $created_time
 * @property bool|null $is_deleted
 * @property int|null $deleted_by
 * @property string|null $deleted_time
 *
 * @property Hospital $hospital
 * @property NonPatient $nonpatient
 * @property PaymentType $paytype
 * @property Registration $registration
 * @property User $createdBy
 * @property User $deletedBy
 */
class Payment extends \yii\db\ActiveRecord
{

    const PY_TNA = 1; //jenis pembyaran tunai (is_discount = false & is_receivable = false)
    const PY_DISC = 2;
    const PY_RCVBL = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['paytype_id', 'registration_id', 'description', 'nominal'], 'required'],
            [['paytype_id', 'registration_id', 'nonpatient_id', 'hospital_id', 'created_by', 'deleted_by'], 'default', 'value' => null],
            [['paytype_id', 'registration_id', 'nonpatient_id', 'hospital_id', 'created_by', 'deleted_by', 'journal_id'], 'integer'],
            [['is_patient', 'is_deleted'], 'boolean'],
            [['description'], 'string'],
            [['nominal'], 'number'],
            [['created_time', 'deleted_time'], 'safe'],
            [['hospital_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hospital::className(), 'targetAttribute' => ['hospital_id' => 'hospital_id']],
            [['nonpatient_id'], 'exist', 'skipOnError' => true, 'targetClass' => NonPatient::className(), 'targetAttribute' => ['nonpatient_id' => 'nonpatient_id']],
            [['paytype_id'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentType::className(), 'targetAttribute' => ['paytype_id' => 'paytype_id']],
            [['registration_id'], 'exist', 'skipOnError' => true, 'targetClass' => Registration::className(), 'targetAttribute' => ['registration_id' => 'registration_id']],
            [['journal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Journal::className(), 'targetAttribute' => ['journal_id' => 'journal_id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'user_id']],
            [['deleted_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['deleted_by' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'payment_id' => Yii::t('app', 'Payment ID'),
            'paytype_id' => Yii::t('app', 'PAYType'),
            'registration_id' => Yii::t('app', 'Registration ID'),
            'nonpatient_id' => Yii::t('app', 'Non Patient ID'),
            'is_patient' => Yii::t('app', 'Is Patient'),
            'description' => Yii::t('app', 'Description'),
            'nominal' => Yii::t('app', 'Nominal'),
            'hospital_id' => Yii::t('app', 'Hospital ID'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_time' => Yii::t('app', 'Created Time'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'deleted_by' => Yii::t('app', 'Deleted By'),
            'deleted_time' => Yii::t('app', 'Deleted Time'),
            'patient_guaranty' => Yii::t('app', 'Guaranty')
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
     * Gets query for [[Nonpatient]].
     *
     * @return \yii\db\ActiveQuery|NonPatientQuery
     */
    public function getNonpatient()
    {
        return $this->hasOne(NonPatient::className(), ['nonpatient_id' => 'nonpatient_id']);
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
     * Gets query for [[Registration]].
     *
     * @return \yii\db\ActiveQuery|RegistrationQuery
     */
    public function getRegistration()
    {
        return $this->hasOne(Registration::className(), ['registration_id' => 'registration_id']);
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
     * Gets query for [[DeletedBy]].
     *
     * @return \yii\db\ActiveQuery|UsersQuery
     */
    public function getDeletedBy()
    {
        return $this->hasOne(User::className(), ['user_id' => 'deleted_by']);
    }

    /**
     * Gets query for [[Journal]].
     *
     * @return \yii\db\ActiveQuery|JournalQuery
     */
    public function getJournal()
    {
        return $this->hasOne(Journal::className(), ['journal_id' => 'journal_id']);
    }

    /**
     * {@inheritdoc}
     * @return PaymentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PaymentQuery(get_called_class());
    }
}
