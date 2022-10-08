<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mrugdlayanan".
 *
 * @property string $ugdlayanan_id
 * @property string|null $ugd_layanan
 *
 * @property Mrrekammedik[] $mrrekammediks
 */
class Mrugdlayanan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mrugdlayanan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ugdlayanan_id'], 'required'],
            [['ugdlayanan_id'], 'string', 'max' => 2],
            [['ugd_layanan'], 'string', 'max' => 100],
            [['ugdlayanan_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ugdlayanan_id' => 'Ugdlayanan ID',
            'ugd_layanan' => 'Emergency Service',
        ];
    }

    /**
     * Gets query for [[Mrrekammediks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMrrekammediks()
    {
        return $this->hasMany(Mrrekammedik::className(), ['ugdlayanan_id' => 'ugdlayanan_id']);
    }
}
