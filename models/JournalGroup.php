<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "journal_group".
 *
 * @property string $jrgroup_id
 * @property string|null $journal_group
 * @property string|null $code
 * @property bool|null $is_active
 * @property string|null $acc_label
 */
class JournalGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'finance.journal_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jrgroup_id'], 'required'],
            [['is_active'], 'boolean'],
            [['jrgroup_id', 'code'], 'string', 'max' => 3],
            [['journal_group', 'acc_label'], 'string', 'max' => 100],
            [['jrgroup_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'jrgroup_id' => Yii::t('app', 'JRGID'),
            'journal_group' => Yii::t('app', 'Journal Group'),
            'code' => Yii::t('app', 'Code'),
            'is_active' => Yii::t('app', 'Is Active'),
            'acc_label' => Yii::t('app', 'Akuntansi Label'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return JournalGroupQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new JournalGroupQuery(get_called_class());
    }
}
