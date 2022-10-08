<?php

namespace app\models;

use app\components\FinanceLogic;
use Yii;

/**
 * This is the model class for table "journal_type".
 *
 * @property int $jtype_id
 * @property int $hospital_id
 * @property string $code
 * @property string $jrtype_name
 * @property string $jrgroup_id
 * @property int $debet_coa_id
 * @property string|null $debet_coa_code
 * @property string|null $debet_coa_name
 * @property int $credit_coa_id
 * @property string|null $credit_coa_code
 * @property string|null $credit_coa_name
 * @property bool|null $is_active
 * @property int|null $created_by
 * @property string|null $created_time
 * @property int|null $updated_by
 * @property string|null $updated_time
 * @property bool|null $is_deleted
 * @property int|null $deleted_by
 * @property string|null $deleted_time
 *
 * @property ChartOfAccount $debetCoa
 * @property ChartOfAccount $creditCoa
 * @property Hospital $hospital
 * @property JournalGroup $jrgroup
 * @property User $createdBy
 * @property User $updatedBy
 * @property User $deletedBy
 */
class JournalType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'finance.journal_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hospital_id', 'code', 'jrtype_name', 'debet_coa_id', 'credit_coa_id'], 'required'],
            [['hospital_id', 'debet_coa_id', 'credit_coa_id', 'created_by', 'updated_by', 'deleted_by'], 'default', 'value' => null],
            [['hospital_id', 'debet_coa_id', 'credit_coa_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['is_active', 'is_deleted'], 'boolean'],
            [['created_time', 'updated_time', 'deleted_time'], 'safe'],
            [['code'], 'string', 'max' => 50],
            [['jrtype_name', 'debet_coa_name', 'credit_coa_name'], 'string', 'max' => 100],
            [['jrgroup_id'], 'string', 'max' => 3],
            [['debet_coa_code', 'credit_coa_code'], 'string', 'max' => 10],
            [['debet_coa_id'], 'exist', 'skipOnError' => true, 'targetClass' => ChartOfAccount::className(), 'targetAttribute' => ['debet_coa_id' => 'coa_id']],
            [['credit_coa_id'], 'exist', 'skipOnError' => true, 'targetClass' => ChartOfAccount::className(), 'targetAttribute' => ['credit_coa_id' => 'coa_id']],
            [['hospital_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hospital::className(), 'targetAttribute' => ['hospital_id' => 'hospital_id']],
            [['jrgroup_id'], 'exist', 'skipOnError' => true, 'targetClass' => JournalGroup::className(), 'targetAttribute' => ['jrgroup_id' => 'jrgroup_id']],
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
            'jtype_id' => Yii::t('app', 'Jtype ID'),
            'hospital_id' => Yii::t('app', 'Hospital ID'),
            'code' => Yii::t('app', 'Code'),
            'jrtype_name' => Yii::t('app', 'Jrtype Name'),
            'jrgroup_id' => Yii::t('app', 'Jrgroup ID'),
            'debet_coa_id' => Yii::t('app', 'Debet Coa ID'),
            'debet_coa_code' => Yii::t('app', 'Debet Coa Code'),
            'debet_coa_name' => Yii::t('app', 'Debet Coa Name'),
            'credit_coa_id' => Yii::t('app', 'Credit Coa ID'),
            'credit_coa_code' => Yii::t('app', 'Credit Coa Code'),
            'credit_coa_name' => Yii::t('app', 'Credit Coa Name'),
            'is_active' => Yii::t('app', 'Is Active'),
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
     * Gets query for [[DebetCoa]].
     *
     * @return \yii\db\ActiveQuery|ChartOfAccountQuery
     */
    public function getDebetCoa()
    {
        return $this->hasOne(ChartOfAccount::className(), ['coa_id' => 'debet_coa_id']);
    }

    /**
     * Gets query for [[CreditCoa]].
     *
     * @return \yii\db\ActiveQuery|ChartOfAccountQuery
     */
    public function getCreditCoa()
    {
        return $this->hasOne(ChartOfAccount::className(), ['coa_id' => 'credit_coa_id']);
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
     * Gets query for [[Jrgroup]].
     *
     * @return \yii\db\ActiveQuery|JournalGroupQuery
     */
    public function getJrgroup()
    {
        return $this->hasOne(JournalGroup::className(), ['jrgroup_id' => 'jrgroup_id']);
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
     * {@inheritdoc}
     * @return JournalTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new JournalTypeQuery(get_called_class());
    }

    public function beforeSave($insert)
    {
        $fin = new FinanceLogic();
        $credit = $fin->getCoaById($this->credit_coa_id);
        $debet = $fin->getCoaById($this->debet_coa_id);
        $this->credit_coa_code = $credit->coa_code;
        $this->credit_coa_name = $credit->coa_name;
        $this->debet_coa_code = $debet->coa_code;
        $this->debet_coa_name = $debet->coa_name;
        if ($this->isNewRecord) {
            $this->created_by = Yii::$app->user->getId();
            $this->created_time = date('Y-m-d H:i:s');
        }
        $this->updated_by = Yii::$app->user->getId();
        $this->updated_time = date('Y-m-d H:i:s');
        return parent::beforeSave($insert);
    }
}
