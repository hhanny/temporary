<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hospital".
 *
 * @property int $hospital_id
 * @property string $code
 * @property string $name
 * @property bool $is_active
 * @property string $created_by
 * @property string $created_time
 *
 * @property ChartOfAccount[] $chartOfAccounts
 * @property ClassRoom[] $classRooms
 * @property ClinicGroup[] $clinicGroups
 * @property ClusterRoom[] $clusterRooms
 * @property Doctor[] $doctors
 * @property Employee[] $employees
 * @property Insurance[] $insurances
 * @property Job[] $jobs
 * @property Journal[] $journals
 * @property JournalType[] $journalTypes
 * @property Patient[] $patients
 * @property PatientRate[] $patientRates
 * @property PaymentType[] $paymentTypes
 * @property Product[] $products
 * @property Registration[] $registrations
 * @property RegistrationReference[] $registrationReferences
 * @property User[] $users
 */
class Hospital extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hospital';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['created_time'], 'safe'],
            [['code'], 'string', 'max' => 50],
            ['code', 'unique'],
            [['name'], 'string', 'max' => 100],
            [['is_active'], 'boolean'],
            [['created_by'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'hospital_id' => Yii::t('app', 'Hospital ID'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Hospital Name'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_time' => Yii::t('app', 'Created Time'),
        ];
    }

    /**
     * Gets query for [[ChartOfAccounts]].
     *
     * @return \yii\db\ActiveQuery|ChartOfAccountQuery
     */
    public function getChartOfAccounts()
    {
        return $this->hasMany(ChartOfAccount::className(), ['hospital_id' => 'hospital_id']);
    }

    /**
     * Gets query for [[ClassRooms]].
     *
     * @return \yii\db\ActiveQuery|ClassRoomQuery
     */
    public function getClassRooms()
    {
        return $this->hasMany(ClassRoom::className(), ['hospital_id' => 'hospital_id']);
    }

    /**
     * Gets query for [[ClinicGroups]].
     *
     * @return \yii\db\ActiveQuery|ClinicGroupQuery
     */
    public function getClinicGroups()
    {
        return $this->hasMany(ClinicGroup::className(), ['hospital_id' => 'hospital_id']);
    }

    /**
     * Gets query for [[ClusterRooms]].
     *
     * @return \yii\db\ActiveQuery|ClusterRoomQuery
     */
    public function getClusterRooms()
    {
        return $this->hasMany(ClusterRoom::className(), ['hospital_id' => 'hospital_id']);
    }

    /**
     * Gets query for [[Doctors]].
     *
     * @return \yii\db\ActiveQuery|DoctorQuery
     */
    public function getDoctors()
    {
        return $this->hasMany(Doctor::className(), ['hospital_id' => 'hospital_id']);
    }

    /**
     * Gets query for [[Employees]].
     *
     * @return \yii\db\ActiveQuery|EmployeeQuery
     */
    public function getEmployees()
    {
        return $this->hasMany(Employee::className(), ['hospital_id' => 'hospital_id']);
    }

    /**
     * Gets query for [[Insurances]].
     *
     * @return \yii\db\ActiveQuery|InsuranceQuery
     */
    public function getInsurances()
    {
        return $this->hasMany(Insurance::className(), ['hospital_id' => 'hospital_id']);
    }

    /**
     * Gets query for [[Jobs]].
     *
     * @return \yii\db\ActiveQuery|JobQuery
     */
    public function getJobs()
    {
        return $this->hasMany(Job::className(), ['hospital_id' => 'hospital_id']);
    }

    /**
     * Gets query for [[Journals]].
     *
     * @return \yii\db\ActiveQuery|JournalQuery
     */
    public function getJournals()
    {
        return $this->hasMany(Journal::className(), ['hospital_id' => 'hospital_id']);
    }

    /**
     * Gets query for [[JournalTypes]].
     *
     * @return \yii\db\ActiveQuery|JournalTypeQuery
     */
    public function getJournalTypes()
    {
        return $this->hasMany(JournalType::className(), ['hospital_id' => 'hospital_id']);
    }

    /**
     * Gets query for [[Patients]].
     *
     * @return \yii\db\ActiveQuery|PatientQuery
     */
    public function getPatients()
    {
        return $this->hasMany(Patient::className(), ['hospital_id' => 'hospital_id']);
    }

    /**
     * Gets query for [[PatientRates]].
     *
     * @return \yii\db\ActiveQuery|PatientRateQuery
     */
    public function getPatientRates()
    {
        return $this->hasMany(PatientRate::className(), ['hospital_id' => 'hospital_id']);
    }

    /**
     * Gets query for [[PaymentTypes]].
     *
     * @return \yii\db\ActiveQuery|PaymentTypeQuery
     */
    public function getPaymentTypes()
    {
        return $this->hasMany(PaymentType::className(), ['hospital_id' => 'hospital_id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery|ProductQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['hospital_id' => 'hospital_id']);
    }

    /**
     * Gets query for [[Registrations]].
     *
     * @return \yii\db\ActiveQuery|RegistrationQuery
     */
    public function getRegistrations()
    {
        return $this->hasMany(Registration::className(), ['hospital_id' => 'hospital_id']);
    }

    /**
     * Gets query for [[RegistrationReferences]].
     *
     * @return \yii\db\ActiveQuery|RegistrationReferenceQuery
     */
    public function getRegistrationReferences()
    {
        return $this->hasMany(RegistrationReference::className(), ['hospital_id' => 'hospital_id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery|UsersQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['hospital_id' => 'hospital_id']);
    }

    /**
     * {@inheritdoc}
     * @return HospitalQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new HospitalQuery(get_called_class());
    }

    public function afterFind()
    {
        $this->created_time = date('d-m-Y H:i:s', strtotime($this->created_time));
        parent::afterFind(); // TODO: Change the autogenerated stub
    }

    public function beforeSave($insert)
    {
        $this->code = strtoupper($this->code);
        $this->name = strtoupper($this->name);
        $this->created_by = Yii::$app->user->getId();
        $this->created_time = date('Y-m-d H:i:s');
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public static function getActive()
    {
        return self::find()->where(['hospital_id' => Yii::$app->user->identity->hospital_id])->all();
    }
}
