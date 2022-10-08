<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "registration_inpatient".
 *
 * @property int $inpatien_id
 * @property int $registration_id
 * @property int $class_id
 * @property int $bed_id
 * @property bool $is_active
 * @property string $date_in
 * @property string $time_in
 * @property string|null $date_out
 * @property string|null $time_out
 * @property int|null $created_by
 * @property string|null $created_time
 * @property int|null $updated_by
 * @property string|null $updated_time
 *
 * @property Bed $bed
 * @property ClassRoom $class
 * @property Registration $registration
 * @property User $createdBy
 * @property User $updatedBy
 */
class RegistrationInpatient extends \yii\db\ActiveRecord
{
    public $sClusterName, $sRoomName;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'registration_inpatient';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['registration_id', 'class_id', 'bed_id', 'date_in', 'time_in'], 'required'],
            [['registration_id', 'class_id', 'bed_id', 'created_by', 'updated_by'], 'default', 'value' => null],
            [['registration_id', 'class_id', 'bed_id', 'created_by', 'updated_by'], 'integer'],
            [['is_active'], 'boolean'],
            [['date_in', 'time_in', 'date_out', 'time_out', 'created_time', 'updated_time'], 'safe'],
            [['bed_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bed::className(), 'targetAttribute' => ['bed_id' => 'bed_id']],
            [['class_id'], 'exist', 'skipOnError' => true, 'targetClass' => ClassRoom::className(), 'targetAttribute' => ['class_id' => 'class_id']],
            [['registration_id'], 'exist', 'skipOnError' => true, 'targetClass' => Registration::className(), 'targetAttribute' => ['registration_id' => 'registration_id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'user_id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'inpatien_id' => Yii::t('app', 'Inpatien ID'),
            'registration_id' => Yii::t('app', 'Registration ID'),
            'class_id' => Yii::t('app', 'Class ID'),
            'bed_id' => Yii::t('app', 'Bed ID'),
            'is_active' => Yii::t('app', 'Is Active'),
            'date_in' => Yii::t('app', 'Date In'),
            'time_in' => Yii::t('app', 'Time In'),
            'date_out' => Yii::t('app', 'Date Out'),
            'time_out' => Yii::t('app', 'Time Out'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_time' => Yii::t('app', 'Created Time'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_time' => Yii::t('app', 'Updated Time'),
            'sRNum' => Yii::t('app', 'Reg Number'),
            'sMRNum' => Yii::t('app', 'MR Number'),
            'sPName' => Yii::t('app', 'Fullname'),
            'sClusterName' => Yii::t('app', 'Cluster'),
            'sRoomName' => Yii::t('app', 'Room'),
            'sBedNum' => Yii::t('app', 'Bed Number'),
        ];
    }

    /**
     * Gets query for [[Bed]].
     *
     * @return \yii\db\ActiveQuery|BedQuery
     */
    public function getBed()
    {
        return $this->hasOne(Bed::className(), ['bed_id' => 'bed_id']);
    }

    /**
     * Gets query for [[Class]].
     *
     * @return \yii\db\ActiveQuery|ClassRoomQuery
     */
    public function getClass()
    {
        return $this->hasOne(ClassRoom::className(), ['class_id' => 'class_id']);
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
     * @return RegistrationInpatientQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RegistrationInpatientQuery(get_called_class());
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

    public static function getActive($rid)
    {
        return self::find()->where(['registration_id' => $rid, 'is_active' => true])->one();
    }
}
