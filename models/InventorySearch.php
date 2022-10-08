<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Inventory;

/**
 * InventorySearch represents the model behind the search form of `app\models\Inventory`.
 */
class InventorySearch extends Inventory
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['inv_id', 'hospital_id', 'invtype_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['name', 'internal_name', 'invgroup_id', 'largeunit_id', 'smallunit_id', 'created_time', 'updated_time', 'deleted_time'], 'safe'],
            [['current_faktor', 'suggested_faktor'], 'number'],
            [['is_deleted', 'is_active'], 'boolean'],
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
        $query = Inventory::find();
        $query->getList();

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
            'inv_id' => $this->inv_id,
            'hospital_id' => $this->hospital_id,
            'current_faktor' => $this->current_faktor,
            'suggested_faktor' => $this->suggested_faktor,
            'is_active' => $this->is_active,
            'invtype_id' => $this->invtype_id,
            'created_by' => $this->created_by,
            'created_time' => $this->created_time,
            'updated_by' => $this->updated_by,
            'updated_time' => $this->updated_time,
            'is_deleted' => $this->is_deleted,
            'deleted_by' => $this->deleted_by,
            'deleted_time' => $this->deleted_time,
        ]);

        $query->andFilterWhere(['ilike', 'name', $this->name])
            ->andFilterWhere(['ilike', 'internal_name', $this->internal_name])
            ->andFilterWhere(['ilike', 'invgroup_id', $this->invgroup_id])
            ->andFilterWhere(['ilike', 'largeunit_id', $this->largeunit_id])
            ->andFilterWhere(['ilike', 'smallunit_id', $this->smallunit_id]);

        return $dataProvider;
    }
}
