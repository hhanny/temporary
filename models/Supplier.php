<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "supplier".
 *
 * @property int $supplier_id
 * @property int|null $hospital_id
 * @property string|null $name
 * @property string|null $address
 * @property string|null $phone
 * @property string|null $pic_name
 * @property string|null $pic_phone
 * @property string|null $npwp
 * @property bool|null $is_active
 * @property int|null $created_by
 * @property string|null $created_time
 * @property int|null $updated_by
 * @property string|null $updated_time
 * @property bool|null $is_deleted
 * @property int|null $deleted_by
 * @property string|null $deleted_time
 *
 * @property Hospital $hospital
 * @property User $createdBy
 * @property User $updatedBy
 * @property User $deletedBy
 */
class Supplier extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'supplier';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hospital_id', 'created_by', 'updated_by', 'deleted_by'], 'default', 'value' => null],
            [['hospital_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['is_active', 'is_deleted'], 'boolean'],
            [['created_time', 'updated_time', 'deleted_time'], 'safe'],
            [['name', 'pic_name', 'npwp'], 'string', 'max' => 50],
            [['address'], 'string', 'max' => 255],
            [['phone', 'pic_phone'], 'string', 'max' => 20],
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
            'supplier_id' => Yii::t('app', 'Supplier ID'),
            'hospital_id' => Yii::t('app', 'Hospital ID'),
            'name' => Yii::t('app', 'Name'),
            'address' => Yii::t('app', 'Address'),
            'phone' => Yii::t('app', 'Phone'),
            'pic_name' => Yii::t('app', 'Pic Name'),
            'pic_phone' => Yii::t('app', 'Pic Phone'),
            'npwp' => Yii::t('app', 'Npwp'),
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
     * {@inheritdoc}
     * @return SupplierQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SupplierQuery(get_called_class());
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->is_active = true;
            $this->created_by = Yii::$app->user->getId();
            $this->created_time = date('Y-m-d H:i:s');
        }
        $this->name = strtoupper($this->name);
        $this->pic_name = strtoupper($this->pic_name);
        $this->updated_by = Yii::$app->user->getId();
        $this->updated_time = date('Y-m-d H:i:s');
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public static function getActive()
    {
        return self::find()->where(['is_active' => true, 'hospital_id' => Yii::$app->user->identity->hospital_id])->all();
    }
}