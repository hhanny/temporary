<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mrugdalasandirujuk".
 *
 * @property string $alasandirujuk_id
 * @property string|null $alasan_dirujuk
 * @property string|null $dirujuk_ke
 *
 * @property Mrrekammedik[] $mrrekammediks
 */
class Mrugdalasandirujuk extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mrugdalasandirujuk';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alasandirujuk_id'], 'required'],
            [['alasandirujuk_id'], 'string', 'max' => 2],
            [['alasan_dirujuk'], 'string', 'max' => 50],
            [['dirujuk_ke'], 'string', 'max' => 100],
            [['alasandirujuk_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'alasandirujuk_id' => 'Alasandirujuk ID',
            'alasan_dirujuk' => 'Reason for Referral',
            'dirujuk_ke' => 'Dirujuk Ke',
        ];
    }

    /**
     * Gets query for [[Mrrekammediks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMrrekammediks()
    {
        return $this->hasMany(Mrrekammedik::className(), ['alasandirujuk_id' => 'alasandirujuk_id']);
    }
}
