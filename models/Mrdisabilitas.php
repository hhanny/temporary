<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mrdisabilitas".
 *
 * @property string $tuna_kode
 * @property string|null $tuna_nama
 *
 * @property Mrrekammedik[] $mrrekammediks
 */
class Mrdisabilitas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mrdisabilitas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tuna_kode'], 'required'],
            [['tuna_kode'], 'string', 'max' => 10],
            [['tuna_nama'], 'string', 'max' => 100],
            [['tuna_kode'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tuna_kode' => 'Tuna Kode',
            'tuna_nama' => 'Tuna Nama',
        ];
    }

    /**
     * Gets query for [[Mrrekammediks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMrrekammediks()
    {
        return $this->hasMany(Mrrekammedik::className(), ['tuna_kode' => 'tuna_kode']);
    }
}
