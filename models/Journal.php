<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "journal".
 *
 * @property int $journal_id
 * @property int|null $hospital_id
 * @property int|null $registration_id
 * @property string $jrgroup_id
 * @property string $jr_num
 * @property string $description
 * @property string $entry_date
 * @property bool|null $is_posting
 * @property string|null $user_posting
 * @property string|null $posting_date
 * @property string|null $posting_time
 * @property int|null $posting_shift
 * @property int|null $jtype_id
 * @property int|null $created_by
 * @property string|null $created_time
 * @property int|null $updated_by
 * @property string|null $updated_time
 * @property bool|null $is_deleted
 * @property int|null $deleted_by
 * @property string|null $deleted_time
 * @property int|null $payment_id
 *
 * @property DebtPayment[] $debtPayments
 * @property Hospital $hospital
 * @property JournalGroup $jrgroup
 * @property JournalType $jtype
 * @property Payment $payment
 * @property User $createdBy
 * @property User $updatedBy
 * @property User $deletedBy
 * @property JournalDetail[] $journalDetails
 */
class Journal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'finance.journal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hospital_id', 'posting_shift', 'jtype_id', 'created_by', 'updated_by', 'deleted_by', 'payment_id'], 'default', 'value' => null],
            [['hospital_id', 'registration_id', 'posting_shift', 'jtype_id', 'created_by', 'updated_by', 'deleted_by', 'payment_id'], 'integer'],
            [['jrgroup_id', 'jr_num', 'description', 'entry_date'], 'required'],
            [['description'], 'string'],
            [['entry_date', 'posting_date', 'posting_time', 'created_time', 'updated_time', 'deleted_time'], 'safe'],
            [['is_posting', 'is_deleted'], 'boolean'],
            [['jrgroup_id'], 'string', 'max' => 2],
            [['jr_num', 'user_posting'], 'string', 'max' => 50],
            [['hospital_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hospital::className(), 'targetAttribute' => ['hospital_id' => 'hospital_id']],
            [['jrgroup_id'], 'exist', 'skipOnError' => true, 'targetClass' => JournalGroup::className(), 'targetAttribute' => ['jrgroup_id' => 'jrgroup_id']],
            [['jtype_id'], 'exist', 'skipOnError' => true, 'targetClass' => JournalType::className(), 'targetAttribute' => ['jtype_id' => 'jtype_id']],
            [['payment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Payment::className(), 'targetAttribute' => ['payment_id' => 'payment_id']],
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
            'journal_id' => Yii::t('app', 'Journal ID'),
            'hospital_id' => Yii::t('app', 'Hospital ID'),
            'registration_id' => Yii::t('app', 'Registration ID'),
            'jrgroup_id' => Yii::t('app', 'Jrgroup ID'),
            'jr_num' => Yii::t('app', 'Number'),
            'description' => Yii::t('app', 'Description'),
            'entry_date' => Yii::t('app', 'Entry Date'),
            'is_posting' => Yii::t('app', 'Is Posting'),
            'user_posting' => Yii::t('app', 'User Posting'),
            'posting_date' => Yii::t('app', 'Posting Date'),
            'posting_time' => Yii::t('app', 'Posting Time'),
            'posting_shift' => Yii::t('app', 'Posting Shift'),
            'jtype_id' => Yii::t('app', 'Jtype ID'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_time' => Yii::t('app', 'Created Time'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_time' => Yii::t('app', 'Updated Time'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'deleted_by' => Yii::t('app', 'Deleted By'),
            'deleted_time' => Yii::t('app', 'Deleted Time'),
            'payment_id' => Yii::t('app', 'Payment ID'),
        ];
    }

    /**
     * Gets query for [[DebtPayments]].
     *
     * @return \yii\db\ActiveQuery|DebtPaymentQuery
     */
    public function getDebtPayments()
    {
        return $this->hasMany(DebtPayment::className(), ['journal_id' => 'journal_id']);
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
     * Gets query for [[Jrgroup]].
     *
     * @return \yii\db\ActiveQuery|JournalGroupQuery
     */
    public function getJrgroup()
    {
        return $this->hasOne(JournalGroup::className(), ['jrgroup_id' => 'jrgroup_id']);
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
     * Gets query for [[Payment]].
     *
     * @return \yii\db\ActiveQuery|PaymentQuery
     */
    public function getPayment()
    {
        return $this->hasOne(Payment::className(), ['payment_id' => 'payment_id']);
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
     * Gets query for [[JournalDetails]].
     *
     * @return \yii\db\ActiveQuery|JournalDetailQuery
     */
    public function getJournalDetails()
    {
        return $this->hasMany(JournalDetail::className(), ['journal_id' => 'journal_id']);
    }

    /**
     * {@inheritdoc}
     * @return JournalQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new JournalQuery(get_called_class());
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->created_by = Yii::$app->user->getId();
            $this->created_time = date('Y-m-d H:i:s');
        }
        $this->updated_by = Yii::$app->user->getId();
        $this->updated_time = date('Y-m-d H:i:s');
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }
}
