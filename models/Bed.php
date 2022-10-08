<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bed".
 *
 * @property int $bed_id
 * @property int $hospital_id
 * @property int $room_id
 * @property string $bed_num
 * @property bool $is_active
 * @property bool $is_available
 * @property int|null $last_used_by
 * @property int|null $created_by
 * @property string|null $created_time
 * @property int|null $updated_by
 * @property string|null $updated_time
 *
 * @property Hospital $hospital
 * @property Registration $lastUsedBy
 * @property Room $room
 * @property User $createdBy
 * @property User $updatedBy
 * @property RegistrationInpatient[] $registrationInpatients
 */
class Bed extends \yii\db\ActiveRecord
{
    public $sClusterName, $sRoomName;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bed';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hospital_id', 'room_id', 'bed_num'], 'required'],
            [['hospital_id', 'room_id', 'last_used_by', 'created_by', 'updated_by'], 'default', 'value' => null],
            [['hospital_id', 'room_id', 'last_used_by', 'created_by', 'updated_by'], 'integer'],
            [['is_active', 'is_available'], 'boolean'],
            [['created_time', 'updated_time'], 'safe'],
            [['bed_num'], 'string', 'max' => 50],
            [['hospital_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hospital::className(), 'targetAttribute' => ['hospital_id' => 'hospital_id']],
            [['last_used_by'], 'exist', 'skipOnError' => true, 'targetClass' => Registration::className(), 'targetAttribute' => ['last_used_by' => 'registration_id']],
            [['room_id'], 'exist', 'skipOnError' => true, 'targetClass' => Room::className(), 'targetAttribute' => ['room_id' => 'room_id']],
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
            'bed_id' => Yii::t('app', 'Bed ID'),
            'hospital_id' => Yii::t('app', 'Hospital ID'),
            'room_id' => Yii::t('app', 'Room ID'),
            'bed_num' => Yii::t('app', 'Bed Num'),
            'is_active' => Yii::t('app', 'Is Active'),
            'is_available' => Yii::t('app', 'Is Available'),
            'last_used_by' => Yii::t('app', 'Last Used By'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_time' => Yii::t('app', 'Created Time'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_time' => Yii::t('app', 'Updated Time'),
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
     * Gets query for [[LastUsedBy]].
     *
     * @return \yii\db\ActiveQuery|RegistrationQuery
     */
    public function getLastUsedBy()
    {
        return $this->hasOne(Registration::className(), ['registration_id' => 'last_used_by']);
    }

    /**
     * Gets query for [[Room]].
     *
     * @return \yii\db\ActiveQuery|RoomQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Room::className(), ['room_id' => 'room_id']);
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
     * Gets query for [[RegistrationInpatients]].
     *
     * @return \yii\db\ActiveQuery|RegistrationInpatientQuery
     */
    public function getRegistrationInpatients()
    {
        return $this->hasMany(RegistrationInpatient::className(), ['bed_id' => 'bed_id']);
    }

    /**
     * {@inheritdoc}
     * @return BedQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BedQuery(get_called_class());
    }

    public function beforeSave($insert)
    {
        $this->bed_num = strtoupper($this->bed_num);
        if ($this->isNewRecord) {
            $this->created_by = Yii::$app->user->getId();
            $this->created_time = date('Y-m-d H:i:s');
        }
        $this->updated_by = Yii::$app->user->getId();
        $this->updated_time = date('Y-m-d H:i:s');

        return parent::beforeSave($insert);
    }

    public static function getActive()
    {
        return self::find()->where(['hospital_id' => Yii::$app->user->identity->hospital_id, 'is_active' => true, 'is_available' => true])->all();
    }
}
