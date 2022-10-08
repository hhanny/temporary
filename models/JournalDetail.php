<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "journal_detail".
 *
 * @property int $jrdet_id
 * @property int|null $journal_id
 * @property string $description
 * @property string $type Debet / Kredit
 * @property int|null $coa_id
 * @property string|null $coa_code
 * @property string|null $coa_name
 * @property float|null $nominal
 * @property float|null $debet_nominal
 * @property float|null $credit_nominal
 * @property int|null $created_by
 * @property string|null $created_time
 * @property int|null $updated_by
 * @property string|null $updated_time
 * @property bool|null $is_deleted
 * @property int|null $deleted_by
 * @property string|null $deleted_time
 *
 * @property ChartOfAccount $coa
 * @property Journal $journal
 * @property User $createdBy
 * @property User $updatedBy
 * @property User $deletedBy
 */
class JournalDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'finance.journal_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['journal_id', 'coa_id', 'created_by', 'updated_by', 'deleted_by'], 'default', 'value' => null],
            [['journal_id', 'coa_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['description', 'type'], 'required'],
            [['description'], 'string'],
            [['nominal', 'debet_nominal', 'credit_nominal'], 'number'],
            [['created_time', 'updated_time', 'deleted_time'], 'safe'],
            [['is_deleted'], 'boolean'],
            [['type'], 'string', 'max' => 5],
            [['coa_code'], 'string', 'max' => 10],
            [['coa_name'], 'string', 'max' => 100],
            [['coa_id'], 'exist', 'skipOnError' => true, 'targetClass' => ChartOfAccount::className(), 'targetAttribute' => ['coa_id' => 'coa_id']],
            [['journal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Journal::className(), 'targetAttribute' => ['journal_id' => 'journal_id']],
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
            'jrdet_id' => Yii::t('app', 'Jrdet ID'),
            'journal_id' => Yii::t('app', 'Journal ID'),
            'description' => Yii::t('app', 'Description'),
            'type' => Yii::t('app', 'D/C'),
            'coa_id' => Yii::t('app', 'Coa ID'),
            'coa_code' => Yii::t('app', 'Coa Code'),
            'coa_name' => Yii::t('app', 'Coa Name'),
            'nominal' => Yii::t('app', 'Nominal'),
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
     * Gets query for [[Coa]].
     *
     * @return \yii\db\ActiveQuery|ChartOfAccountQuery
     */
    public function getCoa()
    {
        return $this->hasOne(ChartOfAccount::className(), ['coa_id' => 'coa_id']);
    }

    /**
     * Gets query for [[Journal]].
     *
     * @return \yii\db\ActiveQuery|JournalQuery
     */
    public function getJournal()
    {
        return $this->hasOne(Journal::className(), ['journal_id' => 'journal_id']);
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
     * @return JournalDetailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new JournalDetailQuery(get_called_class());
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->created_by = Yii::$app->user->getId();
            $this->created_time = date('Y-m-d H:i:s');
        }
        return parent::beforeSave($insert);
    }
}
