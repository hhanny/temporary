<?php

namespace app\models;

use phpDocumentor\Reflection\Types\This;
use Yii;

/**
 * This is the model class for table "unit_group".
 *
 * @property string $unitgroup_id
 * @property string $name
 * @property string $vlabel
 * @property string $s_order
 * @property string $is_active
 * @property int|null $created_by
 * @property string|null $created_time
 * @property int|null $updated_by
 * @property string|null $updated_time
 * @property string $is_deleted
 * @property int|null $deleted_by
 * @property string|null $deleted_time
 *
 * @property Unit[] $units
 * @property User $createdBy
 */
class UnitGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'unit_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['unitgroup_id', 'name'], 'required'],
            [['created_by'], 'default', 'value' => null],
            [['created_by', 's_order'], 'integer'],
            [['created_time'], 'safe'],
            [['is_active', 'is_deleted'], 'boolean'],
            [['unitgroup_id'], 'string', 'max' => 5],
            [['name', 'vlabel'], 'string', 'max' => 100],
            [['unitgroup_id'], 'unique'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'unitgroup_id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Unit Group Name'),
            's_order' => Yii::t('app', 'S Order'),
            'is_active' => Yii::t('app', 'Is Active'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_time' => Yii::t('app', 'Created Time'),
        ];
    }

    /**
     * Gets query for [[Units]].
     *
     * @return \yii\db\ActiveQuery|UnitQuery
     */
    public function getUnits()
    {
        return $this->hasMany(Unit::className(), ['unitgroup_id' => 'unitgroup_id']);
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
     * @return UnitGroupQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UnitGroupQuery(get_called_class());
    }

    public function beforeSave($insert)
    {
        $this->vlabel = strtoupper($this->vlabel);
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
        return self::find()->orderBy('s_order')->all();
    }

    /*
     * list unitgroup yang aktif jika rawat inap
     */
    public static function getMustInPatient()
    {
        return ['RIN', 'IBS'];
    }
}
