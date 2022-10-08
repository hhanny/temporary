<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PaymentType;

/**
 * PaymentTypeSearch represents the model behind the search form of `app\models\PaymentType`.
 */
class PaymentTypeSearch extends PaymentType
{
    public $jrtype_name;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['paytype_id', 'jtype_id', 'hospital_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['name', 'description', 'created_time', 'updated_time', 'deleted_time', 'jrtype_name'], 'safe'],
            [['is_active', 'is_billing', 'is_deleted', 'is_discount', 'is_receivable', 'is_bpjskes'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = PaymentType::find()
            ->alias('t')
            ->joinWith('jtype')
            ->where(['t.is_deleted' => false]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            't.paytype_id' => $this->paytype_id,
            't.jtype_id' => $this->jtype_id,
            't.hospital_id' => $this->hospital_id,
            't.is_active' => $this->is_active,
            't.is_billing' => $this->is_billing,
            't.created_by' => $this->created_by,
            't.created_time' => $this->created_time,
            't.updated_by' => $this->updated_by,
            't.updated_time' => $this->updated_time,
            't.is_deleted' => $this->is_deleted,
            't.is_discount' => $this->is_discount,
            't.is_receivable' => $this->is_receivable,
            't.is_bpjskes' => $this->is_bpjskes,
            't.deleted_by' => $this->deleted_by,
            't.deleted_time' => $this->deleted_time,
        ]);

        $query->andFilterWhere(['ilike', 't.name', $this->name])
            ->andFilterWhere(['ilike', 'journal_type.jor', $this->jrtype_name])
            ->andFilterWhere(['ilike', 't.description', $this->description]);

        return $dataProvider;
    }
}
