<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ethnic;

/**
 * EthnicSearch represents the model behind the search form of `app\models\Ethnic`.
 */
class EthnicSearch extends Ethnic
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ethnic_id', 'ethnic_name', 'created_by', 'created_time'], 'safe']
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
        $query = Ethnic::find();

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
            'created_time' => $this->created_time,
        ]);

        $query->andFilterWhere(['ilike', 'ethnic_id', $this->ethnic_id])
            ->andFilterWhere(['ilike', 'ethnic_name', $this->ethnic_name])
            ->andFilterWhere(['ilike', 'created_by', $this->created_by]);
        return $dataProvider;
    }
}
