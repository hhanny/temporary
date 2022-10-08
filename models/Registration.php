<?php

namespace app\models;

use Yii;


/**
 * This is the model class for table "registration".
 *
 * @property int $registration_id
 * @property int $doctor_id
 * @property int $regref_id
 * @property int $guaranty_id
 * @property int $rate_id
 * @property string $regstts_id
 * @property int $hospital_id
 * @property string $picrel_id
 * @property int $unit_id
 * @property string $regsource_id
 * @property string|null $emergency_id
 * @property string|null $reason_id
 * @property string $reg_num
 * @property int $patient_id
 * @property string $mr_number
 * @property string $date_in
 * @property string|null $date_out
 * @property string $time_in
 * @property string|null $time_out
 * @property bool $is_new_patient
 * @property bool $is_new_unit
 * @property bool $is_inpatient
 * @property string|null $emergency_escort
 * @property string|null $gl_letter_num
 * @property string|null $sender_name
 * @property string $pic_name
 * @property string $pic_phone
 * @property string $pic_address
 * @property int|null $created_by
 * @property string|null $created_time
 * @property int|null $updated_by
 * @property string|null $updated_time
 *
 * @property Doctor $doctor
 * @property Emergency $emergency
 * @property EmergencyReason $reason
 * @property Hospital $hospital
 * @property Patient $patient
 * @property PatientGuaranty $guaranty
 * @property PatientRate $patienrate
 * @property PicRelation $picrel
 * @property RegInpatientSource $regsource
 * @property RegInpatientSource $regsource0
 * @property RegistrationReference $regref
 * @property RegistrationStatus $regstts
 * @property Unit $unit
 */
class Registration extends \yii\db\ActiveRecord
{
    /* @registration_status
     * Active : pasien masih dalam perawatan di rs
     * NonActive : pasien sudah tidak dalam perawatan rs
     * Cancel : batal transaksi
     */
    const Active = '01';
    const NonActive = '02';
    const Cancel = '99';

    /* @registration_source
     * sumber rawat inap (dari RJL/Rawat Jalan atau IGD)
     */
    const UG_RJL = 'RJL';
    const UG_IGD = 'IGD';
    const UG_RIN = 'RIN';
    const UG_IBS = 'IBS';

    public $reg_patient_name, $class_name, $class_id, $room_name, $cls_room, $clstroom_id, $bed_num;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'registration';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['doctor_id', 'regref_id', 'guaranty_id', 'rate_id', 'regstts_id', 'hospital_id', 'picrel_id', 'unit_id', 'regsource_id', 'reg_num', 'patient_id', 'mr_number', 'date_in', 'time_in', 'pic_name', 'pic_phone', 'pic_address'], 'required'],
            [['doctor_id', 'regref_id', 'guaranty_id', 'rate_id', 'hospital_id', 'unit_id', 'patient_id', 'created_by', 'updated_by'], 'default', 'value' => null],
            [['doctor_id', 'regref_id', 'guaranty_id', 'rate_id', 'hospital_id', 'unit_id', 'patient_id', 'created_by', 'updated_by'], 'integer'],
            [['date_in', 'date_out', 'time_in', 'time_out', 'created_time', 'updated_time', 'reg_patient_name'], 'safe'],
            [['is_new_patient', 'is_new_unit', 'is_inpatient'], 'boolean'],
            [['regstts_id', 'picrel_id', 'emergency_id', 'reason_id'], 'string', 'max' => 2],
            [['regsource_id'], 'string', 'max' => 10],
            [['reg_num', 'sender_name'], 'string', 'max' => 100],
            [['mr_number'], 'string', 'max' => 20],
            [['emergency_escort', 'gl_letter_num'], 'string', 'max' => 50],
            [['pic_name'], 'string', 'max' => 200],
            [['pic_address'], 'string', 'max' => 255],
            [['pic_phone'], 'string', 'max' => 30],
            [['reg_num', 'hospital_id'], 'unique', 'targetAttribute' => ['reg_num', 'hospital_id']],
            [['doctor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Doctor::className(), 'targetAttribute' => ['doctor_id' => 'doctor_id']],
            [['emergency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Emergency::className(), 'targetAttribute' => ['emergency_id' => 'emergency_id']],
            [['reason_id'], 'exist', 'skipOnError' => true, 'targetClass' => EmergencyReason::className(), 'targetAttribute' => ['reason_id' => 'reason_id']],
            [['hospital_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hospital::className(), 'targetAttribute' => ['hospital_id' => 'hospital_id']],
            [['patient_id'], 'exist', 'skipOnError' => true, 'targetClass' => Patient::className(), 'targetAttribute' => ['patient_id' => 'patient_id']],
            [['guaranty_id'], 'exist', 'skipOnError' => true, 'targetClass' => PatientGuaranty::className(), 'targetAttribute' => ['guaranty_id' => 'guaranty_id']],
            [['rate_id'], 'exist', 'skipOnError' => true, 'targetClass' => PatientRate::className(), 'targetAttribute' => ['rate_id' => 'rate_id']],
            [['picrel_id'], 'exist', 'skipOnError' => true, 'targetClass' => PicRelation::className(), 'targetAttribute' => ['picrel_id' => 'picrel_id']],
            [['regsource_id'], 'exist', 'skipOnError' => true, 'targetClass' => RegInpatientSource::className(), 'targetAttribute' => ['regsource_id' => 'regsource_id']],
            [['regsource_id'], 'exist', 'skipOnError' => true, 'targetClass' => RegInpatientSource::className(), 'targetAttribute' => ['regsource_id' => 'regsource_id']],
            [['regref_id'], 'exist', 'skipOnError' => true, 'targetClass' => RegistrationReference::className(), 'targetAttribute' => ['regref_id' => 'regref_id']],
            [['regstts_id'], 'exist', 'skipOnError' => true, 'targetClass' => RegistrationStatus::className(), 'targetAttribute' => ['regstts_id' => 'regstts_id']],
            [['unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => Unit::className(), 'targetAttribute' => ['unit_id' => 'unit_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'registration_id' => Yii::t('app', 'RegID'),
            'doctor_id' => Yii::t('app', 'Dokter'),
            'regref_id' => Yii::t('app', 'Referensi'),
            'guaranty_id' => Yii::t('app', 'Penjamin'),
            'rate_id' => Yii::t('app', 'Rate'),
            'regstts_id' => Yii::t('app', 'Status'),
            'hospital_id' => Yii::t('app', 'RSID'),
            'picrel_id' => Yii::t('app', 'Relasi'),
            'unit_id' => Yii::t('app', 'Unit'),
            'regsource_id' => Yii::t('app', 'Sumber'),
            'emergency_id' => Yii::t('app', 'Kegawatan'),
            'reason_id' => Yii::t('app', 'Alasan'),
            'reg_num' => Yii::t('app', 'No Reg'),
            'patient_id' => Yii::t('app', 'PID'),
            'mr_number' => Yii::t('app', 'No RM'),
            'date_in' => Yii::t('app', 'Tgl Masuk'),
            'date_out' => Yii::t('app', 'Tgl Keluar'),
            'time_in' => Yii::t('app', 'Waktu Masuk'),
            'time_out' => Yii::t('app', 'Waktu Keluar'),
            'is_new_patient' => Yii::t('app', 'Pasien Baru?'),
            'is_new_unit' => Yii::t('app', 'Unit Baru?'),
            'is_inpatient' => Yii::t('app', 'Pasien Inap?'),
            'emergency_escort' => Yii::t('app', 'Emergency Escort'),
            'gl_letter_num' => Yii::t('app', 'Gl Letter Num'),
            'sender_name' => Yii::t('app', 'Pengirim'),
            'pic_name' => Yii::t('app', 'PJ Name'),
            'pic_phone' => Yii::t('app', 'PJ Phone'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_time' => Yii::t('app', 'Created Time'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_time' => Yii::t('app', 'Updated Time'),
            'is_deleted' => Yii::t('app', 'Is Deleted?'),
            'deleted_time' => Yii::t('app', 'Deleted Time'),
            'reg_patient_name' => Yii::t('app', 'Nama Pasien'),
            'clstroom_id' => Yii::t('app', 'Cluster'),
            'class_id' => Yii::t('app', 'Class')
        ];
    }

    /**
     * Gets query for [[Doctor]].
     *
     * @return \yii\db\ActiveQuery|DoctorQuery
     */
    public function getDoctor()
    {
        return $this->hasOne(Doctor::className(), ['doctor_id' => 'doctor_id']);
    }

    /**
     * Gets query for [[Emergency]].
     *
     * @return \yii\db\ActiveQuery|EmergencyQuery
     */
    public function getEmergency()
    {
        return $this->hasOne(Emergency::className(), ['emergency_id' => 'emergency_id']);
    }

    /**
     * Gets query for [[Reason]].
     *
     * @return \yii\db\ActiveQuery|EmergencyReasonQuery
     */
    public function getReason()
    {
        return $this->hasOne(EmergencyReason::className(), ['reason_id' => 'reason_id']);
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
     * Gets query for [[Patient]].
     *
     * @return \yii\db\ActiveQuery|PatientQuery
     */
    public function getPatient()
    {
        return $this->hasMany(Patient::className(), ['patient_id' => 'patient_id']);
    }

    /**
     * Gets query for [[Guaranty]].
     *
     * @return \yii\db\ActiveQuery|PatientGuarantyQuery
     */
    public function getGuaranty()
    {
        return $this->hasOne(PatientGuaranty::className(), ['guaranty_id' => 'guaranty_id']);
    }

    /**
     * Gets query for [[Patienrate]].
     *
     * @return \yii\db\ActiveQuery|PatientRateQuery
     */
    public function getRate()
    {
        return $this->hasOne(PatientRate::className(), ['rate_id' => 'rate_id']);
    }

    /**
     * Gets query for [[Picrel]].
     *
     * @return \yii\db\ActiveQuery|PicRelationQuery
     */
    public function getPicrel()
    {
        return $this->hasOne(PicRelation::className(), ['picrel_id' => 'picrel_id']);
    }

    /**
     * Gets query for [[Regsource]].
     *
     * @return \yii\db\ActiveQuery|RegInpatientSourceQuery
     */
    public function getRegsource()
    {
        return $this->hasOne(RegInpatientSource::className(), ['regsource_id' => 'regsource_id']);
    }

    /**
     * Gets query for [[Regsource0]].
     *
     * @return \yii\db\ActiveQuery|RegInpatientSourceQuery
     */
    public function getRegsource0()
    {
        return $this->hasOne(RegInpatientSource::className(), ['regsource_id' => 'regsource_id']);
    }

    /**
     * Gets query for [[Regref]].
     *
     * @return \yii\db\ActiveQuery|RegistrationReferenceQuery
     */
    public function getRegref()
    {
        return $this->hasOne(RegistrationReference::className(), ['regref_id' => 'regref_id']);
    }

    /**
     * Gets query for [[Regstts]].
     *
     * @return \yii\db\ActiveQuery|RegistrationStatusQuery
     */
    public function getRegstts()
    {
        return $this->hasOne(RegistrationStatus::className(), ['regstts_id' => 'regstts_id']);
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
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery|UsersQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['user_id' => 'updated_by']);
    }


    /**
     * {@inheritdoc}
     * @return RegistrationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RegistrationQuery(get_called_class());
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->created_by = Yii::$app->user->getId();
            $this->created_time = date('Y-m-d H:i:s');
        }
        $this->pic_name = strtoupper($this->pic_name);
        $this->pic_address = strtoupper($this->pic_address);
        $this->updated_by = Yii::$app->user->getId();
        $this->updated_time = date('Y-m-d H:i:s');
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function setIsNewPatient()
    {
        $mdl = self::find()->where(['patient_id' => $this->patient_id])->one();
        if ($mdl == null) {
            return true;
        }
        return false;
    }

    public function getRegistration()
    {
        return $this->hasOne(Registration::className(), ['registration_id' => 'registration_id']);
    }

    public function setIsNewUnit()
    {
        $mdl = self::find()->where(['patient_id' => $this->patient_id, 'unit_id' => $this->unit_id])->one();
        if ($mdl == null) {
            return true;
        }
        return false;
    }

    public function setRegsourceId()
    {
        $mdl = Unit::findOne($this->unit_id);
        if ($mdl->unitgroup_id == self::UG_RJL) {
            return '01';
        } elseif ($mdl->unitgroup_id == self::UG_IGD) {
            return '02';
        }
    }

    public function setNewRegNumber()
    {
        $mdl = Unit::findOne($this->unit_id);
        $mReg = self::find()->select('max(reg_num) as reg_num')->where(['unit_id' => $this->unit_id])->one();
        $label = explode('-', $mReg['reg_num']);
        $num = (int)$label[2] + 1;
        return $mdl->unit_code . '-' . date('ym') . '-' . str_pad($num, 4, 0, STR_PAD_LEFT);
    }

    public function getPIDActive($pid)
    {
        return self::find()->where(['patient_id' => $pid, 'regstts_id' => self::Active])->one();
    }

    public function getPIDActiveInap($pid)
    {
        return self::find()
            ->alias('t')
            ->joinWith(['unit'])
            ->where(['t.patient_id' => $pid, 't.is_inpatient' => true, 't.regstts_id' => self::Active, 'unit.unitgroup_id' => self::UG_RIN])
            ->one();
    }

    public function getIGDCode()
    {
        return Unit::find()->where(['hospital_id' => Yii::$app->user->identity->hospital_id, 'unitgroup_id' => self::UG_IGD, 'is_active' => true])->one();
    }

    public function getPatients()
    {
        return $this->hasMany(Patient::className(), ['patient_id' => 'patient_id']);
    }

    public static function getActive($id)
    {
        return self::find()->where(['registration_id' => $id, 'regstts_id' => self::Active])->one();
    }
}
