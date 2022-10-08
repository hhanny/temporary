<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_rate".
 *
 * @property int $prdrate_id
 * @property int $hospital_id
 * @property int $product_id
 * @property int|null $class_id
 * @property string|null $name
 * @property float|null $nominal
 * @property bool|null $is_active
 * @property int|null $created_by
 * @property string|null $created_time
 * @property int|null $updated_by
 * @property string|null $updated_time
 * @property bool|null $is_deleted
 * @property int|null $deleted_by
 * @property string|null $deleted_time
 *
 * @property ClassRoom $class
 * @property Hospital $hospital
 * @property Product $product
 * @property User $createdBy
 * @property User $updatedBy
 * @property User $deletedBy
 */
class ProductRate extends \yii\db\ActiveRecord
{
    public $class_name;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_rate';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hospital_id', 'product_id'], 'required'],
            [['hospital_id', 'product_id', 'class_id', 'created_by', 'updated_by', 'deleted_by'], 'default', 'value' => null],
            [['hospital_id', 'product_id', 'class_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['nominal'], 'number'],
            [['is_active', 'is_deleted'], 'boolean'],
            [['created_time', 'updated_time', 'deleted_time'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['class_id'], 'exist', 'skipOnError' => true, 'targetClass' => ClassRoom::className(), 'targetAttribute' => ['class_id' => 'class_id']],
            [['hospital_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hospital::className(), 'targetAttribute' => ['hospital_id' => 'hospital_id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'product_id']],
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
            'prdrate_id' => Yii::t('app', 'RTID'),
            'hospital_id' => Yii::t('app', 'Hospital ID'),
            'product_id' => Yii::t('app', 'PRDID'),
            'class_id' => Yii::t('app', 'Class ID'),
            'name' => Yii::t('app', 'Name'),
            'nominal' => Yii::t('app', 'Nominal'),
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
     * Gets query for [[Class]].
     *
     * @return \yii\db\ActiveQuery|ClassRoomQuery
     */
    public function getClass()
    {
        return $this->hasOne(ClassRoom::className(), ['class_id' => 'class_id']);
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
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery|ProductQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['product_id' => 'product_id']);
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
     * @return ProductRateQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductRateQuery(get_called_class());
    }
}
