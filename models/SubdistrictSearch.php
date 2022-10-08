<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Subdistrict;

/**
 * SubdistrictSearch represents the model behind the search form of `app\models\Subdistrict`.
 */
class SubdistrictSearch extends Subdistrict
{
    public $dst_search, $prv_search;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subdistrict_id', 'district_id', 'subdistrict_name', 'dst_search', 'prv_search'], 'safe'],
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
        $query = Subdistrict::find()
            ->alias('t')
            ->leftJoin('district d', 'd.district_id=t.district_id')
            ->leftJoin('province p', 'p.prv_id=d.prv_id');

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
        $query->andFilterWhere(['ilike', 'subdistrict_id', $this->subdistrict_id])
            ->andFilterWhere(['ilike', 'district_id', $this->district_id])
            ->andFilterWhere(['ilike', 'p.prv_name', $this->prv_search])
            ->andFilterWhere(['ilike', 'd.district_name', $this->dst_search])
            ->andFilterWhere(['ilike', 'subdistrict_name', $this->subdistrict_name]);

        return $dataProvider;
    }
}
