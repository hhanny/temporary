<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EmergencyReason;

/**
 * EmergencyReasonSearch represents the model behind the search form of `app\models\EmergencyReason`.
 */
class EmergencyReasonSearch extends EmergencyReason
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reason_id', 'name', 'created_time', 'updated_time'], 'safe'],
            [['s_order', 'created_by', 'updated_by'], 'integer'],
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
        $query = EmergencyReason::find();

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
            's_order' => $this->s_order,
            'created_by' => $this->created_by,
            'created_time' => $this->created_time,
            'updated_by' => $this->updated_by,
            'updated_time' => $this->updated_time,
        ]);

        $query->andFilterWhere(['ilike', 'reason_id', $this->reason_id])
            ->andFilterWhere(['ilike', 'name', $this->name]);

        return $dataProvider;
    }
}
