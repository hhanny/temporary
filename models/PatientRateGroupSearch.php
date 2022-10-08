<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PatientRateGroup;

/**
 * PatientRateGroupSearch represents the model behind the search form of `app\models\PatientRateGroup`.
 */
class PatientRateGroupSearch extends PatientRateGroup
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prg_id', 'name', 'created_time'], 'safe'],
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
        $query = PatientRateGroup::find();

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
            'created_by' => $this->created_by,
            'created_time' => $this->created_time,
        ]);

        $query->andFilterWhere(['ilike', 'prg_id', $this->prg_id])
            ->andFilterWhere(['ilike', 'name', $this->name]);

        return $dataProvider;
    }
}
