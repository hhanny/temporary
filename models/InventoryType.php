<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inventory_type".
 *
 * @property int $invtype_id
 * @property int|null $hospital_id
 * @property string|null $inv_name obat infus sirup
 * @property bool|null $is_active
 * @property int|null $created_by
 * @property string|null $created_time
 * @property int|null $updated_by
 * @property string|null $updated_time
 * @property bool|null $is_deleted
 * @property int|null $deleted_by
 * @property string|null $deleted_time
 * @property string|null $id_x
 */
class InventoryType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inventory_type';
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
            [['inv_name'], 'string', 'max' => 255],
            [['id_x'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'invtype_id' => Yii::t('app', 'Invtype ID'),
            'hospital_id' => Yii::t('app', 'Hospital ID'),
            'inv_name' => Yii::t('app', 'obat infus sirup'),
            'is_active' => Yii::t('app', 'Is Active'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_time' => Yii::t('app', 'Created Time'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_time' => Yii::t('app', 'Updated Time'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'deleted_by' => Yii::t('app', 'Deleted By'),
            'deleted_time' => Yii::t('app', 'Deleted Time'),
            'id_x' => Yii::t('app', 'Id X'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return InventoryTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InventoryTypeQuery(get_called_class());
    }
}
