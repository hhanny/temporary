<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "class_room".
 *
 * @property int $class_id
 * @property int $hospital_id
 * @property string $class_name
 * @property bool $is_active
 * @property bool $is_general
 * @property int|null $created_by
 * @property string|null $created_time
 * @property int|null $updated_by
 * @property string|null $updated_time
 *
 * @property Hospital $hospital
 * @property User $createdBy
 * @property User $updatedBy
 */
class ClassRoom extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'class_room';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hospital_id', 'class_name'], 'required'],
            [['hospital_id', 'created_by', 'updated_by'], 'default', 'value' => null],
            [['hospital_id', 'created_by', 'updated_by'], 'integer'],
            [['is_active', 'is_general'], 'boolean'],
            [['created_time', 'updated_time'], 'safe'],
            [['class_name'], 'string', 'max' => 15],
            [['hospital_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hospital::className(), 'targetAttribute' => ['hospital_id' => 'hospital_id']],
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
            'class_id' => Yii::t('app', 'Class ID'),
            'hospital_id' => Yii::t('app', 'Hospital ID'),
            'class_name' => Yii::t('app', 'Class Name'),
            'is_active' => Yii::t('app', 'Is Active'),
            'is_general' => Yii::t('app', 'Is General'),
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
     * @return ClassRoomQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ClassRoomQuery(get_called_class());
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

    public static function getActive()
    {
        return self::find()->where(['hospital_id' => Yii::$app->user->identity->hospital_id, 'is_active' => true])->all();
    }
}
