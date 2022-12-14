<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "patient_rate".
 *
 * @property int $patienrate_id
 * @property int $hospital_id
 * @property string $prg_id
 * @property string $name
 * @property bool $is_active
 * @property int|null $created_by
 * @property string|null $created_time
 * @property int|null $updated_by
 * @property string|null $updated_time
 *
 * @property Hospital $hospital
 * @property PatientRateGroup $prg
 * @property User $createdBy
 * @property User $updatedBy
 */
class PatientRate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'patient_rate';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hospital_id', 'prg_id', 'name', 'is_active'], 'required'],
            [['hospital_id', 'created_by', 'updated_by'], 'default', 'value' => null],
            [['hospital_id', 'created_by', 'updated_by'], 'integer'],
            [['is_active'], 'boolean'],
            [['created_time', 'updated_time'], 'safe'],
            [['prg_id'], 'string', 'max' => 2],
            [['name'], 'string', 'max' => 100],
            [['hospital_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hospital::className(), 'targetAttribute' => ['hospital_id' => 'hospital_id']],
            [['prg_id'], 'exist', 'skipOnError' => true, 'targetClass' => PatientRateGroup::className(), 'targetAttribute' => ['prg_id' => 'prg_id']],
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
            'patienrate_id' => Yii::t('app', 'Patienrate ID'),
            'hospital_id' => Yii::t('app', 'Hospital ID'),
            'prg_id' => Yii::t('app', 'Group'),
            'name' => Yii::t('app', 'Name'),
            'is_active' => Yii::t('app', 'Is Active'),
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
     * Gets query for [[Prg]].
     *
     * @return \yii\db\ActiveQuery|PatientRateGroupQuery
     */
    public function getPrg()
    {
        return $this->hasOne(PatientRateGroup::className(), ['prg_id' => 'prg_id']);
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
     * @return PatientRateQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PatientRateQuery(get_called_class());
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->created_by = Yii::$app->user->getId();
            $this->created_time = date('Y-m-d H:i:s');
        }
        $this->name = strtoupper($this->name);
        $this->updated_by = Yii::$app->user->getId();
        $this->updated_time = date('Y-m-d H:i:s');
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public static function getActive()
    {
        return self::find()->where(['is_active' => true, 'hospital_id' => Yii::$app->user->identity->hospital_id])->all();
    }
}
