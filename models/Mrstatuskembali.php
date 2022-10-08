<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mrstatuskembali".
 *
 * @property int $statuskembali_id
 * @property string|null $nama_statuskembali
 *
 * @property Mrrekammedik[] $mrrekammediks
 */
class Mrstatuskembali extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mrstatuskembali';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['statuskembali_id'], 'required'],
            [['statuskembali_id'], 'default', 'value' => null],
            [['statuskembali_id'], 'integer'],
            [['nama_statuskembali'], 'string', 'max' => 100],
            [['statuskembali_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'statuskembali_id' => 'Statuskembali ID',
            'nama_statuskembali' => 'Back Status Name',
        ];
    }

    /**
     * Gets query for [[Mrrekammediks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMrrekammediks()
    {
        return $this->hasMany(Mrrekammedik::className(), ['statuskembali_id' => 'statuskembali_id']);
    }
}
