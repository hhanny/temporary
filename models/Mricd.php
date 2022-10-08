<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mricd".
 *
 * @property string|null $icd_kode
 * @property string|null $deskripsi
 * @property string|null $keterangan
 * @property string|null $wabah
 * @property string|null $surv_urut
 * @property string|null $imun_jenis
 */
class Mricd extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mricd';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['icd_kode'], 'string', 'max' => 20],
            [['deskripsi'], 'string', 'max' => 200],
            [['keterangan'], 'string', 'max' => 100],
            [['wabah'], 'string', 'max' => 1],
            [['surv_urut', 'imun_jenis'], 'string', 'max' => 3],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'icd_kode' => 'Icd Kode',
            'deskripsi' => 'Deskripsi',
            'keterangan' => 'Keterangan',
            'wabah' => 'Wabah',
            'surv_urut' => 'Surv Urut',
            'imun_jenis' => 'Imun Jenis',
        ];
    }
}
