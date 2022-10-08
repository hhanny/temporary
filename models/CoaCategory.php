<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "coa_category".
 *
 * @property string $ccat_code
 * @property string $ccat_name
 * @property bool $is_active
 * @property int|null $created_by
 * @property string|null $created_time
 * @property int|null $updated_by
 * @property string|null $updated_time
 * @property bool $is_deleted
 * @property int|null $deleted_by
 * @property string|null $deleted_time
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property User $deletedBy
 */
class CoaCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'finance.coa_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ccat_code', 'ccat_name'], 'required'],
            [['is_active', 'is_deleted'], 'boolean'],
            [['created_by', 'updated_by', 'deleted_by'], 'default', 'value' => null],
            [['created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_time', 'updated_time', 'deleted_time'], 'safe'],
            [['ccat_code'], 'string', 'max' => 10],
            [['ccat_name'], 'string', 'max' => 100],
            [['ccat_code'], 'unique'],
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
            'ccat_code' => Yii::t('app', 'C Code'),
            'ccat_name' => Yii::t('app', 'COA Category'),
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
     * @return CoaCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CoaCategoryQuery(get_called_class());
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->created_by = Yii::$app->user->getId();
            $this->created_time = date('Y-m-d H:i:s');
        }
        $this->ccat_name = strtoupper($this->ccat_name);
        $this->updated_by = Yii::$app->user->getId();
        $this->updated_time = date('Y-m-d H:i:s');
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public static function getActive()
    {
        return self::find()->where(['is_active' => true, 'is_deleted' => false])->all();
    }
}
