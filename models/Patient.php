<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "patient".
 *
 * @property int $patient_id
 * @property string $marital_status_id
 * @property string $gender_id
 * @property string $education_id
 * @property string $blood_id
 * @property int $job_id
 * @property string $religion_id
 * @property string $subdistrict_id
 * @property string $ethnic_id
 * @property int $hospital_id
 * @property string $mr_number
 * @property string $fullname
 * @property string $nickname
 * @property string|null $identity_number
 * @property string $address
 * @property string $village
 * @property string $phone
 * @property string $birth_place
 * @property string $date_of_birth
 * @property string|null $office_address
 * @property int|null $created_by
 * @property string|null $created_time
 * @property int|null $updated_by
 * @property string|null $updated_time
 * @property bool|null $is_deleted
 * @property int|null $deleted_by
 * @property string|null $deleted_time
 *
 * @property BloodType $blood
 * @property Education $education
 * @property Ethnic $ethnic
 * @property Gender $gender
 * @property Hospital $hospital
 * @property Job $job
 * @property MaritalStatus $maritalStatus
 * @property Religion $religion
 * @property Subdistrict $subdistrict
 * @property User $createdBy
 * @property User $updatedBy
 * @property User $deletedBy
 * @property Registration[] $registrations
 */
class Patient extends \yii\db\ActiveRecord
{
    public $fulladdress;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'patient';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['marital_status_id', 'gender_id', 'education_id', 'blood_id', 'job_id', 'religion_id', 'subdistrict_id', 'ethnic_id', 'hospital_id', 'mr_number', 'fullname', 'nickname', 'address', 'village', 'phone', 'birth_place', 'date_of_birth'], 'required'],
            [['job_id', 'hospital_id', 'created_by', 'updated_by', 'deleted_by'], 'default', 'value' => null],
            [['job_id', 'hospital_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['address'], 'string'],
            [['date_of_birth', 'created_time', 'updated_time', 'deleted_time'], 'safe'],
            [['is_deleted'], 'boolean'],
            [['marital_status_id', 'gender_id', 'religion_id', 'ethnic_id'], 'string', 'max' => 2],
            [['education_id', 'blood_id'], 'string', 'max' => 3],
            [['subdistrict_id'], 'string', 'max' => 10],
            [['mr_number'], 'string', 'max' => 20],
            [['fullname', 'village'], 'string', 'max' => 100],
            [['nickname', 'identity_number', 'birth_place'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 32],
            [['office_address'], 'string', 'max' => 40],
            [['mr_number', 'hospital_id'], 'unique', 'targetAttribute' => ['mr_number', 'hospital_id']],
            [['blood_id'], 'exist', 'skipOnError' => true, 'targetClass' => BloodType::className(), 'targetAttribute' => ['blood_id' => 'blood_id']],
            [['education_id'], 'exist', 'skipOnError' => true, 'targetClass' => Education::className(), 'targetAttribute' => ['education_id' => 'education_id']],
            [['ethnic_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ethnic::className(), 'targetAttribute' => ['ethnic_id' => 'ethnic_id']],
            [['gender_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gender::className(), 'targetAttribute' => ['gender_id' => 'gender_id']],
            [['hospital_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hospital::className(), 'targetAttribute' => ['hospital_id' => 'hospital_id']],
            [['job_id'], 'exist', 'skipOnError' => true, 'targetClass' => Job::className(), 'targetAttribute' => ['job_id' => 'job_id']],
            [['marital_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => MaritalStatus::className(), 'targetAttribute' => ['marital_status_id' => 'marital_status_id']],
            [['religion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Religion::className(), 'targetAttribute' => ['religion_id' => 'religion_id']],
            [['subdistrict_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subdistrict::className(), 'targetAttribute' => ['subdistrict_id' => 'subdistrict_id']],
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
            'patient_id' => Yii::t('app', 'PID'),
            'marital_status_id' => Yii::t('app', 'Marital Status ID'),
            'gender_id' => Yii::t('app', 'Gender ID'),
            'education_id' => Yii::t('app', 'Education ID'),
            'blood_id' => Yii::t('app', 'Blood ID'),
            'job_id' => Yii::t('app', 'Job ID'),
            'religion_id' => Yii::t('app', 'Religion ID'),
            'subdistrict_id' => Yii::t('app', 'Subdistrict ID'),
            'ethnic_id' => Yii::t('app', 'Ethnic ID'),
            'hospital_id' => Yii::t('app', 'Hospital ID'),
            'mr_number' => Yii::t('app', 'No RM'),
            'fullname' => Yii::t('app', 'Full Name'),
            'nickname' => Yii::t('app', 'Nama Panggilan'),
            'identity_number' => Yii::t('app', 'KTP/SIM'),
            'address' => Yii::t('app', 'Address'),
            'village' => Yii::t('app', 'Desa/Kelurahan'),
            'phone' => Yii::t('app', 'No Hp/Telp'),
            'birth_place' => Yii::t('app', 'Tempat Lahir'),
            'date_of_birth' => Yii::t('app', 'Tgl Lahir'),
            'office_address' => Yii::t('app', 'Alamat Kantor'),
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
     * Gets query for [[Blood]].
     *
     * @return \yii\db\ActiveQuery|BloodTypeQuery
     */
    public function getBlood()
    {
        return $this->hasOne(BloodType::className(), ['blood_id' => 'blood_id']);
    }

    /**
     * Gets query for [[Education]].
     *
     * @return \yii\db\ActiveQuery|EducationQuery
     */
    public function getEducation()
    {
        return $this->hasOne(Education::className(), ['education_id' => 'education_id']);
    }

    /**
     * Gets query for [[Ethnic]].
     *
     * @return \yii\db\ActiveQuery|EthnicQuery
     */
    public function getEthnic()
    {
        return $this->hasOne(Ethnic::className(), ['ethnic_id' => 'ethnic_id']);
    }

    /**
     * Gets query for [[Gender]].
     *
     * @return \yii\db\ActiveQuery|GenderQuery
     */
    public function getGender()
    {
        return $this->hasOne(Gender::className(), ['gender_id' => 'gender_id']);
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
     * Gets query for [[Job]].
     *
     * @return \yii\db\ActiveQuery|JobQuery
     */
    public function getJob()
    {
        return $this->hasOne(Job::className(), ['job_id' => 'job_id']);
    }

    /**
     * Gets query for [[MaritalStatus]].
     *
     * @return \yii\db\ActiveQuery|MaritalStatusQuery
     */
    public function getMaritalStatus()
    {
        return $this->hasOne(MaritalStatus::className(), ['marital_status_id' => 'marital_status_id']);
    }

    /**
     * Gets query for [[Religion]].
     *
     * @return \yii\db\ActiveQuery|ReligionQuery
     */
    public function getReligion()
    {
        return $this->hasOne(Religion::className(), ['religion_id' => 'religion_id']);
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
     * Gets query for [[Registrations]].
     *
     * @return \yii\db\ActiveQuery|RegistrationQuery
     */
    public function getRegistration()
    {
        return $this->hasMany(Registration::className(), ['patient_id' => 'patient_id']);
    }

    
    /**
     * {@inheritdoc}
     * @return PatientQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PatientQuery(get_called_class());
    }

    public function afterFind()
    {
        $this->date_of_birth = date('d-m-Y', strtotime($this->date_of_birth));
        $this->fulladdress = $this->getFullAddress();
        parent::afterFind(); // TODO: Change the autogenerated stub
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->hospital_id = Yii::$app->user->identity->hospital_id;
            $this->created_by = Yii::$app->user->getId();
            $this->created_time = date('Y-m-d H:i:s');
        }
        $this->date_of_birth = (isset($this->date_of_birth) ? date('Y-m-d', strtotime($this->date_of_birth)) : null);
        $this->fullname = strtoupper($this->fullname);
        $this->nickname = strtoupper($this->nickname);
        $this->village = strtoupper($this->village);
        $this->address = strtoupper($this->address);
        $this->birth_place = strtoupper($this->birth_place);
        $this->office_address = strtoupper($this->office_address);
        $this->date_of_birth = date('Y-m-d', strtotime($this->date_of_birth));
        $this->updated_by = Yii::$app->user->getId();
        $this->updated_time = date('Y-m-d H:i:s');
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public static function getNoRm()
    {
        $mdl1 = self::find()->select('max(mr_number) as mr_number')->where(['hospital_id' => Yii::$app->user->identity->hospital_id])->one();
        if ($mdl1['mr_number'] == null) {
            return str_pad('1', 6, '0', STR_PAD_LEFT);
        }
        $num = (int)$mdl1['mr_number'] + 1;
        return str_pad($num, 6, '0', STR_PAD_LEFT);
    }

    public function getFullAddress()
    {
        return $this->subdistrict->subdistrict_name . '/' . $this->subdistrict->district->district_name . '/' . $this->subdistrict->district->prv->prv_name;
    }
}

