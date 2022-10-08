<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PurchaseOrder;

/**
 * PurchaseOrderSearch represents the model behind the search form of `app\models\PurchaseOrder`.
 */
class PurchaseOrderSearch extends PurchaseOrder
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['po_id', 'hospital_id', 'supplier_id', 'unit_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['po_num', 'po_date', 'po_note', 'ref_num', 'ref_date', 'due_date', 'pay_plan_date', 'potype_id', 'created_time', 'updated_time', 'deleted_time', 'receive_date', 'tax_num', 'paytype_id'], 'safe'],
            [['ppn_prosen', 'ppn_nominal'], 'number'],
            [['is_deleted'], 'boolean'],
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
        $query = PurchaseOrder::find();

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
            'po_id' => $this->po_id,
            'hospital_id' => $this->hospital_id,
            'po_date' => $this->po_date,
            'supplier_id' => $this->supplier_id,
            'unit_id' => $this->unit_id,
            'ref_date' => $this->ref_date,
            'due_date' => $this->due_date,
            'pay_plan_date' => $this->pay_plan_date,
            'ppn_prosen' => $this->ppn_prosen,
            'ppn_nominal' => $this->ppn_nominal,
            'created_by' => $this->created_by,
            'created_time' => $this->created_time,
            'updated_by' => $this->updated_by,
            'updated_time' => $this->updated_time,
            'is_deleted' => $this->is_deleted,
            'deleted_by' => $this->deleted_by,
            'deleted_time' => $this->deleted_time,
            'receive_date' => $this->receive_date,
        ]);

        $query->andFilterWhere(['ilike', 'po_num', $this->po_num])
            ->andFilterWhere(['ilike', 'po_note', $this->po_note])
            ->andFilterWhere(['ilike', 'ref_num', $this->ref_num])
            ->andFilterWhere(['ilike', 'potype_id', $this->potype_id])
            ->andFilterWhere(['ilike', 'tax_num', $this->tax_num])
            ->andFilterWhere(['ilike', 'paytype_id', $this->paytype_id]);

        return $dataProvider;
    }
}
