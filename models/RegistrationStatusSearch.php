<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RegistrationStatus;

/**
 * RegistrationStatusSearch represents the model behind the search form of `app\models\RegistrationStatus`.
 */
class RegistrationStatusSearch extends RegistrationStatus
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['regstts_id', 'reg_status', 'created_by', 'created_time'], 'safe'],
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
        $query = RegistrationStatus::find();

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

        $query->andFilterWhere(['ilike', 'regstts_id', $this->regstts_id])
            ->andFilterWhere(['ilike', 'reg_status', $this->reg_status])
            ->andFilterWhere(['ilike', 'created_by', $this->created_by]);

        return $dataProvider;
    }
}
