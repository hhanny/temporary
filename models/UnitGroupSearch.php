<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UnitGroup;

/**
 * UnitGroupSearch represents the model behind the search form of `app\models\UnitGroup`.
 */
class UnitGroupSearch extends UnitGroup
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['unitgroup_id', 'name', 'created_time', 'is_active', 'is_deleted'], 'safe'],
            [['created_by'], 'integer'],
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
        $query = UnitGroup::find();
        $query->getList();
        $query->orderBy('s_order');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'is_active' => $this->is_active,
            'created_by' => $this->created_by,
            'created_time' => $this->created_time,
        ]);

        $query->andFilterWhere(['ilike', 'unitgroup_id', $this->unitgroup_id])
            ->andFilterWhere(['ilike', 'name', $this->name]);

        return $dataProvider;
    }
}
