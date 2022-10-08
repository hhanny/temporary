<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mrdiagnosaawal".
 *
 * @property string $ugddiagnosa_id
 * @property string|null $keterangan
 * @property string|null $tanggal_kontrol
 *
 * @property Mrrekammedik[] $mrrekammediks
 */
class Mrdiagnosaawal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mrdiagnosaawal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ugddiagnosa_id'], 'required'],
            [['tanggal_kontrol'], 'safe'],
            [['ugddiagnosa_id'], 'string', 'max' => 2],
            [['keterangan'], 'string', 'max' => 100],
            [['ugddiagnosa_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ugddiagnosa_id' => 'Ugddiagnosa ID',
            'keterangan' => 'Keterangan',
            'tanggal_kontrol' => 'Control Date',
        ];
    }

    /**
     * Gets query for [[Mrrekammediks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMrrekammediks()
    {
        return $this->hasMany(Mrrekammedik::className(), ['ugddiagnosa_id' => 'ugddiagnosa_id']);
    }
}
