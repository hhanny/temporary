<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "chart_of_account".
 *
 * @property int $coa_id
 * @property int $hospital_id
 * @property string $ccat_code
 * @property string $coa_code
 * @property string $coa_name
 * @property int|null $parent
 * @property string $coa_description
 * @property bool $is_active
 * @property int|null $created_by
 * @property string|null $created_time
 * @property int|null $updated_by
 * @property string|null $updated_time
 * @property bool|null $is_deleted
 * @property int|null $deleted_by
 * @property string|null $deleted_time
 *
 * @property ChartOfAccount $parent0
 * @property ChartOfAccount[] $chartOfAccounts
 * @property CoaCategory $ccatCode
 * @property Hospital $hospital
 * @property User $createdBy
 * @property User $updatedBy
 * @property User $deletedBy
 * @property Product[] $products
 */
class ChartOfAccount extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'finance.chart_of_account';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hospital_id', 'ccat_code', 'coa_code', 'coa_name', 'coa_description'], 'required'],
            [['hospital_id', 'parent', 'created_by', 'updated_by', 'deleted_by'], 'default', 'value' => null],
            [['hospital_id', 'parent', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['coa_description'], 'string'],
            [['is_active', 'is_deleted'], 'boolean'],
            [['created_time', 'updated_time', 'deleted_time'], 'safe'],
            [['ccat_code', 'coa_code'], 'string', 'max' => 10],
            [['coa_name'], 'string', 'max' => 100],
            [['parent'], 'exist', 'skipOnError' => true, 'targetClass' => ChartOfAccount::className(), 'targetAttribute' => ['parent' => 'coa_id']],
            [['ccat_code'], 'exist', 'skipOnError' => true, 'targetClass' => CoaCategory::className(), 'targetAttribute' => ['ccat_code' => 'ccat_code']],
            [['hospital_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hospital::className(), 'targetAttribute' => ['hospital_id' => 'hospital_id']],
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
            'coa_id' => Yii::t('app', 'Coa ID'),
            'hospital_id' => Yii::t('app', 'Hospital ID'),
            'ccat_code' => Yii::t('app', 'Category'),
            'coa_code' => Yii::t('app', 'COA Code'),
            'coa_name' => Yii::t('app', 'COA Name'),
            'parent' => Yii::t('app', 'Parent'),
            'coa_description' => Yii::t('app', 'Coa Description'),
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
     * Gets query for [[Parent0]].
     *
     * @return \yii\db\ActiveQuery|ChartOfAccountQuery
     */
    public function getParent0()
    {
        return $this->hasOne(ChartOfAccount::className(), ['coa_id' => 'parent']);
    }

    /**
     * Gets query for [[ChartOfAccounts]].
     *
     * @return \yii\db\ActiveQuery|ChartOfAccountQuery
     */
    public function getChartOfAccounts()
    {
        return $this->hasMany(ChartOfAccount::className(), ['parent' => 'coa_id']);
    }

    /**
     * Gets query for [[CcatCode]].
     *
     * @return \yii\db\ActiveQuery|CoaCategoryQuery
     */
    public function getCategory()
    {
        return $this->hasOne(CoaCategory::className(), ['ccat_code' => 'ccat_code']);
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
     * Gets query for [[DeletedBy]].
     *
     * @return \yii\db\ActiveQuery|UsersQuery
     */
    public function getDeletedBy()
    {
        return $this->hasOne(User::className(), ['user_id' => 'deleted_by']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery|ProductQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['coa_id' => 'coa_id']);
    }

    /**
     * {@inheritdoc}
     * @return ChartOfAccountQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ChartOfAccountQuery(get_called_class());
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->created_by = Yii::$app->user->getId();
            $this->created_time = date('Y-m-d H:i:s');
        }
        $this->coa_code = strtoupper($this->coa_code);
        $this->coa_name = strtoupper($this->coa_name);
        $this->updated_by = Yii::$app->user->getId();
        $this->updated_time = date('Y-m-d H:i:s');
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public static function getActive()
    {
        $exp = new Expression('concat(coa_code, \'-\', coa_name) as coa_name');
        return self::find()
            ->select(['coa_id', $exp])
            ->where(['is_active' => true, 'is_deleted' => false, 'hospital_id' => Yii::$app->user->identity->hospital_id])
            ->all();
    }
}
