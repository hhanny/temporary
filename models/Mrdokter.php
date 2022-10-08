<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mrdokter".
 *
 * @property int $dokter_id
 * @property string|null $dokter_code
 * @property string|null $spesialis
 */
class Mrdokter extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mrdokter';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dokter_code'], 'string', 'max' => 6],
            [['spesialis'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'dokter_id' => 'Dokter ID',
            'dokter_code' => 'Dokter Code',
            'spesialis' => 'Spesialis',
        ];
    }

    // public function getMrdokterr()
    // {
    //     return $this->hasOne(Mrdokter::className(), ['dokter_id' => 'dokter_id']);
    // }
}
