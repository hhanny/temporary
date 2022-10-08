<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reg_inpatient_source".
 *
 * @property string $regsource_id
 * @property string $name
 * @property int|null $created_by
 * @property string|null $created_time
 *
 * @property User $createdBy
 * @property Registration[] $registrations
 */
class RegInpatientSource extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reg_inpatient_source';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['regsource_id', 'name'], 'required'],
            [['created_by'], 'default', 'value' => null],
            [['created_by'], 'integer'],
            [['created_time'], 'safe'],
            [['regsource_id'], 'string', 'max' => 10],
            [['name'], 'string', 'max' => 100],
            [['regsource_id'], 'unique'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'regsource_id' => Yii::t('app', 'Regsource ID'),
            'name' => Yii::t('app', 'Name'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_time' => Yii::t('app', 'Created Time'),
        ];
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
     * Gets query for [[Registrations]].
     *
     * @return \yii\db\ActiveQuery|RegistrationQuery
     */
    public function getRegistrations()
    {
        return $this->hasMany(Registration::className(), ['regsource_id' => 'regsource_id']);
    }

    /**
     * {@inheritdoc}
     * @return RegInpatientSourceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RegInpatientSourceQuery(get_called_class());
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->created_by = Yii::$app->user->getId();
            $this->created_time = date('Y-m-d H:i:s');
        }
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }
}