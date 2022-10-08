<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "education".
 *
 * @property string $education_id
 * @property string $edu_name
 * @property integer $s_order
 * @property string $created_by
 * @property string $created_time
 *
 * @property Patient[] $patients
 */
class Education extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'education';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['education_id', 'edu_name'], 'required'],
            [['created_time'], 'safe'],
            [['education_id'], 'string', 'max' => 3],
            [['s_order'], 'integer'],
            [['edu_name'], 'string', 'max' => 100],
            [['created_by'], 'string', 'max' => 20],
            [['education_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'education_id' => Yii::t('app', 'Education ID'),
            'edu_name' => Yii::t('app', 'Edu Name'),
            's_order' => Yii::t('app', 'Order'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_time' => Yii::t('app', 'Created Time'),
        ];
    }

    /**
     * Gets query for [[Patients]].
     *
     * @return \yii\db\ActiveQuery|PatientQuery
     */
    public function getPatients()
    {
        return $this->hasMany(Patient::className(), ['education_id' => 'education_id']);
    }

    /**
     * {@inheritdoc}
     * @return EducationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EducationQuery(get_called_class());
    }

    public function afterFind()
    {
        $this->created_time = date('d-m-Y H:i:s', strtotime($this->created_time));
        parent::afterFind(); // TODO: Change the autogenerated stub
    }

    public function beforeSave($insert)
    {
        $this->created_by = Yii::$app->user->getId();
        $this->created_time = date('Y-m-d H:i:s');
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

}
