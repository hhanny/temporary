<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Journal;

/**
 * JournalSearch represents the model behind the search form of `app\models\Journal`.
 */
class JournalSearch extends Journal
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['journal_id', 'hospital_id', 'registration_id', 'posting_shift', 'jtype_id', 'created_by', 'updated_by', 'deleted_by', 'payment_id'], 'integer'],
            [['jrgroup_id', 'jr_num', 'description', 'entry_date', 'user_posting', 'posting_date', 'posting_time', 'created_time', 'updated_time', 'deleted_time'], 'safe'],
            [['is_posting', 'is_deleted'], 'boolean'],
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
        $query = Journal::find();
        $query->active();

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
            'journal_id' => $this->journal_id,
            'hospital_id' => $this->hospital_id,
            'registration_id' => $this->registration_id,
            'entry_date' => $this->entry_date,
            'is_posting' => $this->is_posting,
            'posting_date' => $this->posting_date,
            'posting_time' => $this->posting_time,
            'posting_shift' => $this->posting_shift,
            'jtype_id' => $this->jtype_id,
            'created_by' => $this->created_by,
            'created_time' => $this->created_time,
            'updated_by' => $this->updated_by,
            'updated_time' => $this->updated_time,
            'is_deleted' => $this->is_deleted,
            'deleted_by' => $this->deleted_by,
            'deleted_time' => $this->deleted_time,
            'payment_id' => $this->payment_id,
        ]);

        $query->andFilterWhere(['ilike', 'jrgroup_id', $this->jrgroup_id])
            ->andFilterWhere(['ilike', 'jr_num', $this->jr_num])
            ->andFilterWhere(['ilike', 'description', $this->description])
            ->andFilterWhere(['ilike', 'user_posting', $this->user_posting]);

        return $dataProvider;
    }
}
