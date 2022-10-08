<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "non_patient".
 *
 * @property int $nonpatient_id
 * @property string $subdistrict_id
 * @property string|null $registration_id
 * @property string|null $name
 * @property string|null $address
 * @property int|null $handphone
 *
 * @property Billing[] $billings
 * @property Subdistrict $subdistrict
 * @property Payment[] $payments
 */
class NonPatient extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'non_patient';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subdistrict_id'], 'required'],
            [['address'], 'string'],
            [['handphone'], 'default', 'value' => null],
            [['handphone'], 'integer'],
            [['subdistrict_id'], 'string', 'max' => 6],
            [['registration_id'], 'string', 'max' => 10],
            [['name'], 'string', 'max' => 100],
            [['subdistrict_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subdistrict::className(), 'targetAttribute' => ['subdistrict_id' => 'subdistrict_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nonpatient_id' => Yii::t('app', 'Nonpatient ID'),
            'subdistrict_id' => Yii::t('app', 'Subdistrict ID'),
            'registration_id' => Yii::t('app', 'Registration ID'),
            'name' => Yii::t('app', 'Name'),
            'address' => Yii::t('app', 'Address'),
            'handphone' => Yii::t('app', 'Handphone'),
        ];
    }

    /**
     * Gets query for [[Billings]].
     *
     * @return \yii\db\ActiveQuery|BillingQuery
     */
    public function getBillings()
    {
        return $this->hasMany(Billing::className(), ['nonpatient_id' => 'nonpatient_id']);
    }

    /**
     * Gets query for [[Subdistrict]].
     *
     * @return \yii\db\ActiveQuery|SubdistrictQuery
     */
    public function getSubdistrict()
    {
        return $this->hasOne(Subdistrict::className(), ['subdistrict_id' => 'subdistrict_id']);
    }

    /**
     * Gets query for [[Payments]].
     *
     * @return \yii\db\ActiveQuery|PaymentQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payment::className(), ['nonpatient_id' => 'nonpatient_id']);
    }

    /**
     * {@inheritdoc}
     * @return NonPatientQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NonPatientQuery(get_called_class());
    }
}
