<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mrjenisctev".
 *
 * @property string $jenisctev_id
 * @property string|null $jenis_ctev
 *
 * @property Mrrekammedik[] $mrrekammediks
 */
class Mrjenisctev extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mrjenisctev';
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jenisctev_id'], 'required'],
            [['jenisctev_id'], 'string', 'max' => 2],
            [['jenis_ctev'], 'string', 'max' => 50],
            [['jenisctev_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'jenisctev_id' => 'Jenisctev ID',
            'jenis_ctev' => 'Jenis Ctev',
        ];
    }

    /**
     * Gets query for [[Mrrekammediks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMrrekammediks()
    {
        return $this->hasMany(Mrrekammedik::className(), ['jenisctev_id' => 'jenisctev_id']);
    }

    public static function getActive()
    {
        return self::find()->where(['hospital_id' => Yii::$app->user->identity->hospital_id, 'is_active' => true])->all();
    }
}
