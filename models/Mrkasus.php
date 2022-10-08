<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mrkasus".
 *
 * @property int $kasus_id
 * @property string|null $nama_kasus
 * @property string|null $keterangan
 *
 * @property Mrrekammedik[] $mrrekammediks
 */
class Mrkasus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mrkasus';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_kasus'], 'string', 'max' => 20],
            [['keterangan'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kasus_id' => 'Kasus ID',
            'nama_kasus' => 'Case Name',
            'keterangan' => 'Keterangan',
        ];
    }

    /**
     * Gets query for [[Mrrekammediks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMrrekammediks()
    {
        return $this->hasMany(Mrrekammedik::className(), ['kasus_id' => 'kasus_id']);
    }
}
