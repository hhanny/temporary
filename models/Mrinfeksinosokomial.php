<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mrinfeksinosokomial".
 *
 * @property int $infonoso_id
 * @property string|null $infeksi_nosokomial
 *
 * @property Mrrekammedik[] $mrrekammediks
 */
class Mrinfeksinosokomial extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mrinfeksinosokomial';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['infonoso_id'], 'required'],
            [['infonoso_id'], 'default', 'value' => null],
            [['infonoso_id'], 'integer'],
            [['infeksi_nosokomial'], 'string', 'max' => 50],
            [['infonoso_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'infonoso_id' => 'Infonoso ID',
            'infeksi_nosokomial' => 'Infeksi Nosokomial',
        ];
    }

    /**
     * Gets query for [[Mrrekammediks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMrrekammediks()
    {
        return $this->hasMany(Mrrekammedik::className(), ['infonoso_id' => 'infonoso_id']);
    }
}
