<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\JournalGroup;

/**
 * JournalGroupSearch represents the model behind the search form of `app\models\JournalGroup`.
 */
class JournalGroupSearch extends JournalGroup
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jrgroup_id', 'journal_group', 'code'], 'safe'],
            [['is_active'], 'boolean'],
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
        $query = JournalGroup::find();

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
            'is_active' => $this->is_active,
        ]);

        $query->andFilterWhere(['ilike', 'jrgroup_id', $this->jrgroup_id])
            ->andFilterWhere(['ilike', 'journal_group', $this->journal_group])
            ->andFilterWhere(['ilike', 'code', $this->code]);

        return $dataProvider;
    }
}
